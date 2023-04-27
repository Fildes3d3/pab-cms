<?php

namespace App\Security;

class Identity implements \JsonSerializable
{
    public function __construct(
        private readonly IdentityType $identityType,
        private readonly ?int         $userId = null,
    ) {

    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'userId' => $this->userId,
            'type' => $this->identityType,
        ];
    }
}
