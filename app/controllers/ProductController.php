<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $this->call->view('products/index', ['products' => $this->ProductModel->get_all()]);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

    public function store()
    {
        $this->ProductModel->insert($this->form_data());
        redirect('login/products');
    }

    public function edit($id)
    {
        $product = $this->ProductModel->get_by_id($id);
        if (!$product) {
            redirect('login/products');
            return;
        }
        $this->call->view('products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $this->ProductModel->update($id, $this->form_data());
        redirect('login/products');
    }

    public function delete($id)
    {
        $this->ProductModel->delete($id);
        redirect('login/products');
    }

    private function form_data()
    {
        return [
            'product_name' => trim((string)$this->io->post('product_name')),
            'description' => trim((string)$this->io->post('description')),
            'price' => (float)$this->io->post('price'),
            'quantity' => (int)$this->io->post('quantity'),
        ];
    }

    private function require_login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['logged_in'])) {
            redirect('login');
            exit;
        }
    }
}
