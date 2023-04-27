<?php

namespace App\Repository;

use App\Security\Session;
use App\Security\SessionRepository;
use Predis\ClientInterface;

final class RedisSessionRepository implements SessionRepository
{
    public function __construct(private readonly ClientInterface $redis)
    {

    }

    public function create(int $userId): string
    {
        $sessionId = bin2hex(random_bytes(16));

        $this->redis->hmset(
            "sessions.$sessionId",
            [
                'userId' => $userId,
                'createdAt' => time()
            ]
        );

        $this->touch($sessionId);

        return $sessionId;
    }

    public function find(string $sessionId): ?Session
    {
        $data = $this->redis->hGetAll("sessions.$sessionId");

        if (!$data) {
            return null;
        }

        return new Session(
            $sessionId,
            (int) $data['userId'],
            (new \DateTime())->setTimestamp($data['createdAt'])
        );
    }

    public function touch(string $sessionId): void
    {
        $expiration = (new \DateTimeImmutable())->modify('+1 day')->getTimestamp();
        $this->redis->expireAt("sessions.$sessionId", $expiration);
    }

    public function delete(string $sessionId): void
    {
        $this->redis->del("sessions.$sessionId");
    }
}
