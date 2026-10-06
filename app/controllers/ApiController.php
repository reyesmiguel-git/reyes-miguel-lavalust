<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('ProductModel');
        $this->call->model('UsersModel');
    }

    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: https://reyes-miguel-product-frontend.onrender.com');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Credentials: true');
        http_response_code(204);
        exit;
    }

    $this->api->respond([
        'debug' => 'LOGIN FUNCTION REACHED',
        'method' => $_SERVER['REQUEST_METHOD']
    ]);
        $this->api->require_method('POST');
        $input = $this->api->body();

        $username = trim($input['username'] ?? '');
        $password = (string)($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required.', 422);
        }

        $user = $this->UsersModel->get_user_by_username($username);

        if (!$user || !$this->password_matches($password, $user['password'] ?? '')) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id' => (int)$user['id'],
            'role' => $user['role'] ?? 'user',
            'scopes' => ['products:read', 'products:write'],
        ]);

        $this->api->respond([
            'message' => 'Login successful.',
            'user' => [
                'id' => (int)$user['id'],
                'username' => $user['username'],
                'role' => $user['role'] ?? 'user',
            ],
            'tokens' => $tokens,
        ]);
    }
public function debug()
{
    header('Content-Type: application/json');

    echo json_encode([
        'debug' => 'CONTROLLER REACHED'
    ]);

    exit;
}
    public function refresh()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $refreshToken = (string)($input['refresh_token'] ?? '');

        if ($refreshToken === '') {
            $this->api->respond_error('Refresh token is required.', 422);
        }

        $this->api->refresh_access_token($refreshToken);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $refreshToken = (string)($input['refresh_token'] ?? '');

        if ($refreshToken !== '') {
            $this->api->revoke_refresh_token($refreshToken);
        }

        $this->api->respond(['message' => 'Logged out successfully.']);
    }

    public function products()
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();

        $this->api->respond($this->ProductModel->get_all());
    }

    public function create_product()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();

        $data = $this->validated_product_data($this->api->body());
        $this->ProductModel->insert($data);

        $this->api->respond([
            'message' => 'Product created successfully.'
        ], 201);
    }

    public function update_product($id)
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
        if (!in_array($method, ['PUT', 'PATCH'], true)) {
            $this->api->respond_error('Method Not Allowed', 405);
        }

        $this->api->require_jwt();

        $product = $this->ProductModel->get_by_id($id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }

        $data = $this->validated_product_data($this->api->body());
        $this->ProductModel->update($id, $data);

        $this->api->respond(['message' => 'Product updated successfully.']);
    }

    public function delete_product($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();

        $product = $this->ProductModel->get_by_id($id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }

        $this->ProductModel->delete($id);
        $this->api->respond(['message' => 'Product deleted successfully.']);
    }

    private function validated_product_data(array $input)
    {
        $name = trim($input['product_name'] ?? '');
        $description = trim($input['description'] ?? '');
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if ($name === '') {
            $this->api->respond_error('Product name is required.', 422);
        }

        if ($price === null || !is_numeric($price) || (float)$price < 0) {
            $this->api->respond_error('Price must be a valid non-negative number.', 422);
        }

        if ($quantity === null || filter_var($quantity, FILTER_VALIDATE_INT) === false || (int)$quantity < 0) {
            $this->api->respond_error('Quantity must be a valid non-negative integer.', 422);
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float)$price, 2, '.', ''),
            'quantity' => (int)$quantity,
        ];
    }

    private function password_matches($plainPassword, $storedPassword)
    {
        if ($storedPassword === '') {
            return false;
        }

        $info = password_get_info($storedPassword);
        if (!empty($info['algo'])) {
            return password_verify($plainPassword, $storedPassword);
        }

        // Compatibility with older classroom databases that stored plain text.
        return hash_equals((string)$storedPassword, (string)$plainPassword);
    }
}
