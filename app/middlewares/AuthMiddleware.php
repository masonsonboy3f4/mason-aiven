<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $session = load_class('session', 'libraries');

        if (empty($session->userdata('user_id'))) {
            redirect('login');
            return;
        }

        return $next();
    }
}