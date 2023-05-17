<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\BlockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlockRepository::class)]
#[ORM\Table(name: '`block`')]
#[ApiResource(
    description: "basic building modules for pages",
    operations: [
        new Get(uriTemplate: '/block/{id}'),
        new GetCollection(uriTemplate: '/block/'),
        new Post(uriTemplate: '/block/'),
        new Put(uriTemplate: '/block/{id}'),
        new Delete(uriTemplate: '/block/{id}')
    ],
    extraProperties: [
        'standard_put' => true
    ]
)]
class Block implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::JSON)]
    private array $content;

    #[ORM\Column(type: Types::JSON)]
    private array $settings;

    #[ORM\Column(type: Types::TEXT)]
    private string $type;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $updatedAt;

    public function __construct()
    {
        $this->content = [];
        $this->settings = [];
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function setSettings(array $settings): self
    {
        $this->settings = $settings;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->getContent(),
            'settings' => $this->getSettings(),
            'type' => $this->type,
            'createdAt' => $this->getCreatedAt(),
            'updatedAt'=> $this->getUpdatedAt(),
        ];
    }
}
