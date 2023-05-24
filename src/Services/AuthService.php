<?php

namespace App\Services;

use App\Entity\User;

class AuthService
{
    public function __construct(private ?User $user = null)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

}