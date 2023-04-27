<?php

namespace App\Security;

use App\Entity\User;

final class UserAuthorization implements Authorization
{
    public function __construct(
        private Identity $identity,
        private User $user,
    ) {

    }

    public function canLogin(): bool
    {
        return true;
    }

    public function canLogout(): bool
    {
        return true;
    }

    public function getIdentity(): Identity
    {
        return new Identity(IdentityType::User, $this->user->getId());
    }

    public function isAnonymous(): bool
    {
        return false;
    }
}
