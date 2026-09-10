
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 */
class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->library('session');
        $this->call->model('UserModel');
    }

    // Show login page
    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('products');
            return;
        }

        $this->call->view('users/login', [
            'errors' => [],
            'username' => ''
        ]);
    }

    // Process login
    public function authenticate()
    {
        $username = trim((string) $this->request->post('username', ''));
        $password = (string) $this->request->post('password', '');

        $errors = [];

        // Check required fields
        if ($username === '' || $password === '') {

            $errors[] = 'Username and password are required.';

        } else {

            // Find the user in the USERSs table
            $user = $this->UserModel->find_by('username', $username);

            if (!$user) {

                $errors[] = 'Invalid username or password.';

            } else {

                // Get password from userss
                if (is_object($user)) {
                    $storedPassword = $user->password;
                    $userId = $user->id;
                } else {
                    $storedPassword = $user['password'];
                    $userId = $user['id'];
                }

                // Check password
                $isActive = is_object($user) ? $user->is_active : $user['is_active'];

                if ((int) $isActive !== 1 || !password_verify($password, $storedPassword)) {

                    $errors[] = 'Invalid username or password.';

                } else {

                    // Login successful
                    session_regenerate_id(true);
                    $this->session->set_userdata([
                        'user_id' => $userId,
                        'username' => is_object($user) ? $user->username : $user['username']
                    ]);

                    redirect('products');
                    return;

                }
            }
        }

        // Login failed
        $this->call->view('users/login', [
            'errors' => $errors,
            'username' => $username
        ]);
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    // Users page
    public function index()
    {
        // Get all records from userss
        $data['users'] = $this->UserModel->all();

        $this->call->view('users/index', $data);
    }
}
