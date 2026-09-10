<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $this->call->view('products/index', [
            'products' => $this->ProductModel->order_by('id', 'DESC'),
            'flash' => $this->pull_flash(),
        ]);
    }

    public function create()
    {
        $this->call->view('products/create', [
            'form' => $this->empty_form(),
            'errors' => [],
        ]);
    }

    public function store()
    {
        $form = $this->product_input();
        $errors = $this->validate_product($form);

        if (!empty($errors)) {
            $this->call->view('products/create', compact('form', 'errors'));
            return;
        }

        $this->ProductModel->insert($form);
        $this->flash('success', 'Product created successfully.');
        $this->redirect_to_products();
    }

    public function edit($id)
    {
        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            $this->flash('error', 'Product not found.');
            $this->redirect_to_products();
            return;
        }

        $this->call->view('products/edit', ['product' => $product, 'errors' => []]);
    }

    public function update($id)
    {
        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            $this->flash('error', 'Product not found.');
            $this->redirect_to_products();
            return;
        }

        $form = $this->product_input();
        $errors = $this->validate_product($form);

        if (!empty($errors)) {
            $product = array_merge($product, $form);
            $this->call->view('products/edit', compact('product', 'errors'));
            return;
        }

        $this->ProductModel->update((int) $id, $form);
        $this->flash('success', 'Product updated successfully.');
        $this->redirect_to_products();
    }

    public function delete($id)
    {
        if ($this->ProductModel->find((int) $id)) {
            $this->ProductModel->delete((int) $id);
            $this->flash('success', 'Product deleted successfully.');
        } else {
            $this->flash('error', 'Product not found.');
        }

        $this->redirect_to_products();
    }

    private function product_input()
    {
        return [
            'product_name' => trim((string) $this->request->post('product_name', '')),
            'description' => trim((string) $this->request->post('description', '')),
            'price' => trim((string) $this->request->post('price', '')),
            'quantity' => trim((string) $this->request->post('quantity', '')),
        ];
    }

    private function empty_form()
    {
        return ['product_name' => '', 'description' => '', 'price' => '', 'quantity' => ''];
    }

    private function validate_product($form)
    {
        $errors = [];

        if ($form['product_name'] === '') {
            $errors[] = 'Product name is required.';
        } elseif (mb_strlen($form['product_name']) > 100) {
            $errors[] = 'Product name must be 100 characters or fewer.';
        }

        if (mb_strlen($form['description']) > 10000) {
            $errors[] = 'Description must be 10,000 characters or fewer.';
        }

        if ($form['price'] === '' || !is_numeric($form['price']) || (float) $form['price'] < 0) {
            $errors[] = 'Price must be a number greater than or equal to 0.';
        } elseif (strlen((string) $form['price']) > 10) {
            $errors[] = 'Price must fit the database decimal format.';
        }

        if (filter_var($form['quantity'], FILTER_VALIDATE_INT) === false || (int) $form['quantity'] < 0) {
            $errors[] = 'Quantity must be a whole number greater than or equal to 0.';
        }

        return $errors;
    }

    private function flash($type, $message)
    {
        $this->start_session();
        $_SESSION['product_flash'] = ['type' => $type, 'message' => $message];
    }

    private function pull_flash()
    {
        $this->start_session();
        $flash = $_SESSION['product_flash'] ?? null;
        unset($_SESSION['product_flash']);
        return $flash;
    }

    private function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function redirect_to_products()
    {
        redirect('products');
        exit;
    }
}