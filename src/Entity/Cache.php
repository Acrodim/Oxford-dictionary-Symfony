<?php

namespace App\Entity;

use App\Repository\CacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CacheRepository::class)
 */
class Cache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private ?string $uriKey;

    /**
     * @ORM\Column(type="json")
     */
    private array $value = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUriKey(): ?string
    {
        return $this->uriKey;
    }

    public function setUriKey(string $uriKey): self
    {
        $this->uriKey = $uriKey;

        return $this;
    }

    public function getValue(): ?array
    {
        return $this->value;
    }

    public function setValue(array $value): self
    {
        $this->value = $value;

        return $this;
    }
}
