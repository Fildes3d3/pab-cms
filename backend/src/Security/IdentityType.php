<?php

namespace App\Security;

enum IdentityType: string
{
    case Anonymous = 'anonymous';
    case User = 'user';
    case Admin = 'admin';
}
