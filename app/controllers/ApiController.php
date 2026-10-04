<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->library('api');
        $this->call->model(['ProductModel', 'UserModel']);
    }

    public function login()
    {
        $this->api->rate_limit('api-login');
        $input = $this->request_body();
        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required.', 422);
        }

        $user = $this->UserModel->find_by('username', $username);
        if (!$user) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $stored_password = is_object($user) ? $user->password : $user['password'];
        $user_id = is_object($user) ? $user->id : $user['id'];
        $is_active = is_object($user) ? $user->is_active : $user['is_active'];
        $stored_username = is_object($user) ? $user->username : $user['username'];

        if ((int) $is_active !== 1 || !password_verify($password, $stored_password)) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id' => (int) $user_id,
            'scopes' => ['products:read', 'products:write'],
        ]);

        $this->api->respond([
            'user' => ['id' => (int) $user_id, 'username' => $stored_username],
            'tokens' => $tokens,
        ]);
    }

    public function logout()
    {
        $this->api->require_jwt();
        $input = $this->request_body();
        $refresh_token = $input['refresh_token'] ?? '';

        if ($refresh_token !== '') {
            $this->api->revoke_refresh_token($refresh_token);
        }

        $this->api->respond(['message' => 'Logged out successfully.']);
    }

    public function products()
    {
        $this->require_product_scope('read');
        $this->api->respond(['products' => $this->ProductModel->order_by('id', 'DESC')]);
    }

    public function create_product()
    {
        $this->require_product_scope('write');
        $data = $this->validated_product($this->request_body());
        $this->ProductModel->insert($data);
        $this->api->respond(['message' => 'Product created successfully.'], 201);
    }

    public function update_product(int $id)
    {
        $this->require_product_scope('write');
        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }

        $data = $this->validated_product($this->request_body());
        $this->ProductModel->update((int) $id, $data);
        $this->api->respond(['message' => 'Product updated successfully.']);
    }

    public function delete_product(int $id)
    {
        $this->require_product_scope('delete');

        if (!$this->ProductModel->find((int) $id)) {
            $this->api->respond_error('Product not found.', 404);
        }

        $this->ProductModel->delete((int) $id);
        $this->api->respond(['message' => 'Product deleted successfully.']);
    }

    private function require_product_scope(string $scope): void
    {
        $auth = $this->api->require_jwt();

        if (!in_array($scope, $auth['scopes'] ?? [], true)) {
            $this->api->respond_error('Forbidden', 403);
        }
    }

    private function validated_product(array $input)
    {
        $product_name = trim((string) ($input['product_name'] ?? ''));
        $description = trim((string) ($input['description'] ?? ''));
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if ($product_name === '' || mb_strlen($product_name) > 100) {
            $this->api->respond_error('Product name is required and must be 100 characters or fewer.', 422);
        }

        if (mb_strlen($description) > 10000) {
            $this->api->respond_error('Description must be 10,000 characters or fewer.', 422);
        }

        if (!is_numeric($price) || (float) $price < 0 || (float) $price > 99999999.99) {
            $this->api->respond_error('Price must fit DECIMAL(10,2) and be non-negative.', 422);
        }

        if (filter_var($quantity, FILTER_VALIDATE_INT) === false || (int) $quantity < 0) {
            $this->api->respond_error('Quantity must be a non-negative whole number.', 422);
        }

        return [
            'product_name' => $product_name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => (int) $quantity,
        ];
    }

    private function request_body()
    {
        $content_type = $_SERVER['CONTENT_TYPE'] ?? '';
        if (stripos($content_type, 'application/json') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);
            return is_array($input) ? $input : [];
        }

        return $this->api->body();
    }
}