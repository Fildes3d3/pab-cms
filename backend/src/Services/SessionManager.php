<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Security\AuthenticationResult;
use App\Security\Authorization;
use App\Security\Session;
use App\Security\SessionRepository;
use App\Security\UserAuthorization;
use http\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\RequestStack;

final class SessionManager
{
    public function __construct(
        private SessionRepository $sessionRepository,
        private RequestStack $requestStack,
        private UserRepository $userRepository,
    ) {
        $this->requestStack = $requestStack;
    }

    public function startSession(Authorization $authorization): Session
    {
        if (!$authorization->canLogin()) {
            throw new RuntimeException('Not allowed to start session');
        }

        $userId =  $authorization->getIdentity()->getUserId();
        $id = $this->sessionRepository->create($userId);
        $this->requestStack->getSession()->set('sessionId', $id);

        return new Session(
            $id,
            $userId,
            new \DateTime()
        );
    }

    public function resumeSession(string $sessionId): AuthenticationResult
    {
        try {
            $session = $this->sessionRepository->find($sessionId);
        } catch (\RuntimeException $exception) {
            $this->requestStack->getSession()->remove('sessionId');
            throw new \RuntimeException('Invalid session id.');
        }

        $user = $this->userRepository->findOneBy(['id' => $session->getUserId()]);

        if (null === $user) {
            throw new \RuntimeException("User with id " . $session->getUserId() . " doesn't exist.");
        }

        $authorization = new UserAuthorization($session->getIdentity(), $user);

        if (!$authorization->canLogin()) {
            throw new \RuntimeException('User is not allowed to login.');
        }

        $this->sessionRepository->touch($sessionId);

        return new AuthenticationResult($session, $authorization, $user);
    }

    public function deleteSession(): void
    {
        $this->sessionRepository->delete($this->requestStack->getSession()->getId());
        $this->requestStack->getSession()->remove('sessionId');
    }
}
