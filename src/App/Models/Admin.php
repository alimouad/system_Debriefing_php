<?php

namespace App\Models;
use App\Enums\UserRole;
use App\Models\User;

class Admin extends User{
    private $role = UserRole::ADMIN->value;

    public function role(): string{
        return $this->role;
    }
}