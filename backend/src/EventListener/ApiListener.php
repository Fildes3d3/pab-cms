<?php

namespace App\EventListener;

use App\Controller\RESTController;
use App\Security\AnonymousAuthorization;
use App\Services\AuthorizationService;
use App\Services\SessionManager;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class ApiListener
{
    public function __construct(
        private SessionManager $sessionManager,
    ) {
    }

    #[AsEventListener(event: 'kernel.request', priority: -10)]
    public function onKernelRequest(RequestEvent $requestEvent): void
    {
        $sessionId = null;
        $request = $requestEvent->getRequest();

        if ($request->headers->has(RESTController::AUTHORIZATION_HEADER)) {
            $sessionId = $request->headers->get(RESTController::AUTHORIZATION_HEADER);
        }

        if (null !== $sessionId) {
            $result = $this->sessionManager->resumeSession($sessionId);
            $request->attributes->set(RESTController::SESSION_ATTRIBUTE_KEY, $result->getSession());
            $request->attributes->set(AuthorizationService::AUTHORIZATION_KEY, $result->getAuthorization());
        }

        if (null === $sessionId) {
            $request->attributes->set(AuthorizationService::AUTHORIZATION_KEY, new AnonymousAuthorization());
        }
    }

    public function onKernelException(ExceptionEvent $exceptionEvent): void
    {
        $exception = $exceptionEvent->getThrowable();

        switch (true) {
            case $exception instanceof \RuntimeException:
                $exceptionEvent->setResponse(new JsonResponse([
                    'error' => [
                        'message' => $exception->getMessage(),
                    ],
                ], Response::HTTP_UNAUTHORIZED));
                break;
            default:
                throw $exception;
        }
    }
}
