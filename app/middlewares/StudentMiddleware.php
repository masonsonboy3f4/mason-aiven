<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            isset($_SESSION['student_access']) &&
            $_SESSION['student_access'] === true
        ) {
            return $next();
        }
 
        // Show styled Access Denied page
        $view_path = __DIR__ . '/../views/access_denied.php';

        if (file_exists($view_path)) {
            require $view_path;
            exit;
        }

        die('Access Denied: Student Profile is restricted.');
    }
}