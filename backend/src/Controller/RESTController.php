<?php

namespace App\Controller;

use App\Security\Authorization;
use App\Services\AuthorizationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RESTController extends AbstractController
{
    public const SESSION_ATTRIBUTE_KEY = 'pab.session';
    public const AUTHORIZATION_HEADER = 'X-Auth';
    public const PREVIEW_EXP_SECONDS = 60;

    public static function getSubscribedServices(): array
    {
        $services =  parent::getSubscribedServices();
        $services['authorizationService'] = AuthorizationService::class;

        return $services;
    }

    protected function requiresAuthentication(): ?Authorization
    {
        $authorizationService = $this->container->get('authorizationService');

        if ($authorizationService->getCurrentAuthorization()->isAnonymous()) {
            throw new \RuntimeException('Anonymous user');
        }

        return $authorizationService->getCurrentAuthorization();
    }
}
