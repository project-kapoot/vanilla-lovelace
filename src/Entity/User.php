<?php

namespace App\Entity;

class User {
    public function __construct(
        private readonly array $roles,
    ){}
    
    public function getRoles() : array
    {
        return $this->roles;
    }

    public function hasRole(string $role) : bool
    {
        return in_array($role, $this->roles, true);
    }
}