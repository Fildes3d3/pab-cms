<?php

namespace App\Security;

interface Authorization
{
    public function canLogin();
    public function canLogout();
    public function getIdentity();

    public function isAnonymous(): bool;

}
