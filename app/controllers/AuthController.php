<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    public function login()
    {
        $this->start_session();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim((string)$this->io->post('username'));
            $password = (string)$this->io->post('password');
            $user = $this->UsersModel->get_user_by_username($username);

            if ($user && $this->password_matches($password, $user['password'] ?? '')) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['username'] = $user['username'];
                redirect('login/products');
                return;
            }

            $this->call->view('login', ['message' => 'Invalid username or password.']);
            return;
        }

        $this->call->view('login');
    }

    public function logout()
    {
        $this->start_session();
        session_unset();
        session_destroy();
        redirect('login');
    }

    private function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function password_matches($plainPassword, $storedPassword)
    {
        $info = password_get_info((string)$storedPassword);
        if (!empty($info['algo'])) {
            return password_verify((string)$plainPassword, (string)$storedPassword);
        }
        return $storedPassword !== '' && hash_equals((string)$storedPassword, (string)$plainPassword);
    }
}
