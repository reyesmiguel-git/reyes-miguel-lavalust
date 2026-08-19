<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $hasPass = !empty($_SESSION['student_profile_pass']);
        $issuedAt = $_SESSION['student_profile_pass_time'] ?? 0;
        $isFresh = $issuedAt > 0 && (time() - $issuedAt) <= 30;

        if (!$hasPass || !$isFresh) {
            unset($_SESSION['student_profile_pass'], $_SESSION['student_profile_pass_time']);
            $_SESSION['student_notice'] = 'Access Denied: You cannot open the Student Profile directly. Click "Open Protected Profile" from the Home page first.';
            header('Location: ' . site_url('student'));
            exit;
        }

        // Consume the pass immediately so direct URL access or refresh is blocked again.
        unset($_SESSION['student_profile_pass'], $_SESSION['student_profile_pass_time']);

        $_SESSION['middleware_message'] = 'Access granted by StudentMiddleware after clicking Open Protected Profile.';

        return $next();
    }
}
?>
