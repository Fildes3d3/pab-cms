<?php

namespace App\Security;

use App\Entity\User;

class AuthenticationResult
{
    public function __construct(
        private readonly Session       $session,
        private readonly Authorization $authorization,
        private readonly User          $user,
    ) {

    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getAuthorization(): Authorization
    {
        return $this->authorization;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
