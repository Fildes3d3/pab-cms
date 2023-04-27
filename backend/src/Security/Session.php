<?php

namespace App\Security;

class Session
{
    public function __construct(
        private string $sessionId,
        private int $userId,
        private \DateTime $createdAt,
    ) {

    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getIdentity(): Identity
    {
        return new Identity(IdentityType::User, $this->userId);
    }
}
