<?php

namespace App\Services;

use App\Security\Authorization;
use Symfony\Component\HttpFoundation\RequestStack;

final class AuthorizationService
{
    public const AUTHORIZATION_KEY = 'pab.authorization';

    public function __construct(private readonly RequestStack $requestStack)
    {

    }

    public function getCurrentAuthorization(): ?Authorization
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        return $currentRequest?->attributes->get(self::AUTHORIZATION_KEY);
    }
}
