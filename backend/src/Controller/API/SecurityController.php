<?php

namespace App\Controller\API;

use App\Controller\RESTController;
use App\Entity\User;
use App\Security\Identity;
use App\Security\IdentityType;
use App\Security\UserAuthorization;
use App\Services\AuthorizationService;
use App\Services\SessionManager;
use App\Services\UserManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('sessions')]
class SecurityController extends RESTController
{
    #[Route('/', name: 'app_login', methods: ['POST'])]
    public function login(SessionManager $sessionManager, #[CurrentUser] User $user = null): Response
    {
        if (null === $user) {
            throw new AuthenticationCredentialsNotFoundException('No user with this email found.');
        }

        $identity = new Identity(IdentityType::User, $user->getId());
        $authorization = new UserAuthorization($identity, $user);
        $session = $sessionManager->startSession($authorization);

        return $this->json(
            [
                'user' => $user->getId(),
                'session' => $session->getSessionId(),
            ],
            Response::HTTP_OK
        );
    }

    #[Route('/', name: 'app_logout', methods: ['DELETE'])]
    public function logout(AuthorizationService $authorizationService, SessionManager $sessionManager): Response
    {
        if (null ===  $this->requiresAuthentication()) {
            return $this->json([], 401);
        }

        $authorization = $authorizationService->getCurrentAuthorization();

        if (!$authorization->canLogout()) {
            throw new \RuntimeException('Not allowed to logout');
        }

        $sessionManager->deleteSession();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/me', methods: ['GET'])]
    public function getMe(UserManager $userManager): Response
    {
        if (null ===  $this->requiresAuthentication()) {
            return $this->json([], 401);
        }

        $user = $userManager->getLoggedUser();

        return $this->json(
            [
                'email' => $user->getEmail(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
            ],
            Response::HTTP_OK
        );
    }
}
