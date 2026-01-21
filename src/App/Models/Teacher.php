<?php

namespace App\Models;
use App\Enums\UserRole;
use App\Models\User;

class Teacher extends User{
    private $role = UserRole::TEACHER->value;

    public function role(): string{
        return $this->role;
    }
}