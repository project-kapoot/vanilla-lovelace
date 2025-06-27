<?php

namespace App\Controller;

class DefaultController 
{
    public function home(): array
    {
        return ['home.php'];
    }

    public function login(): array
    {
        return ['login.php'];
    }

    public function register(): array
    {
        return ['register.php'];
    }

    public function profile(): array
    {
        return ['profile.php'];
    }
}