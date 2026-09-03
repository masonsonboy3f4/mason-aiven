<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../middlewares/StudentMiddleware.php';

class StudentController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // CHANGE THIS TO true OR false TO CONTROL PROFILE ACCESS
        $_SESSION['student_access'] = true;

        $this->call->view('student');
    }

    public function profile()
    {
        $middleware = new StudentMiddleware();

        return $middleware->handle(function () {

            $student = [
                'student_id' => 'MCC2024-00192',
                'name' => 'Sonboy F. Mason',
                'course' => 'BS Information Technology',
                'year' => '3rd Year',
                'section' => '3F4',
                'email' => 'masonsonboy67@gmail.com',
                'contact' => '09543922855',
                'address' => 'Masipit, Calapan City',
                'skills' => 'Drawing,Editing',
                'hobbies' => ' Drawing, Swimming, Watching, Gaming',
                'description' => 'A BSIT student passionate about technology, programming, and creativity.',
                'facebook' => 'https://www.facebook.com/share/1C3mbC23Yp/',
                'github' => 'https://github.com/masonsonboy3f4'
            ];

            return $this->call->view('student_profile', $student);
        });
    }
}