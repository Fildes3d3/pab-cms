<?php

namespace App\Controller;

use App\Security\Authorization;
use App\Security\Session;
use App\Services\AuthorizationService;
use http\Exception\RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class RESTController extends AbstractController
{
    public const SESSION_ATTRIBUTE_KEY = 'pab.session';
    public const AUTHORIZATION_HEADER = 'X-Auth';

    protected function requiresAuthentication(AuthorizationService $authorizationService): ?Authorization
    {
        if ($authorizationService->getCurrentAuthorization()->isAnonymous()) {
            throw new \RuntimeException('Anonymous user');
        }

        return $authorizationService->getCurrentAuthorization();
    }
}
