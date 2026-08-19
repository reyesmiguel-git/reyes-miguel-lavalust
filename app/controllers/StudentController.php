<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function studentData()
    {
        return [
            'student_id' => 'MCC2024 - 00267',
            'name'       => 'Reyes Miguel Ramos',
            'course'     => 'BSIT',
            'year'       => '3rd Year',
            'section'    => '3F6',
            'email'      => 'reyesmiguel0415@gmail.com'
        ];
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Visiting Home alone does NOT grant access to the profile.
        $data = $this->studentData();
        $data['notice'] = $_SESSION['student_notice'] ?? null;
        unset($_SESSION['student_notice']);

        $this->call->view('student/student_home', $data);
    }

    public function openProfile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only this action, reached by clicking "Open Protected Profile",
        // grants a one-time pass for the middleware-protected route.
        $_SESSION['student_profile_pass'] = bin2hex(random_bytes(16));
        $_SESSION['student_profile_pass_time'] = time();

        header('Location: ' . site_url('student/profile'));
        exit;
    }

    public function profile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = $this->studentData();
        $data['middleware_message'] = $_SESSION['middleware_message'] ?? 'Access verified by StudentMiddleware.';
        unset($_SESSION['middleware_message']);

        $this->call->view('student/student_profile', $data);
    }
}
?>
