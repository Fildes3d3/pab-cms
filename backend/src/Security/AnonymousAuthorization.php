<?php

namespace App\Security;

final class AnonymousAuthorization implements Authorization
{
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
        return new Identity(IdentityType::Anonymous);
    }

    public function isAnonymous(): bool
    {
        return true;
    }
}
