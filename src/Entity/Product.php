<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Index(columns: ['sku'], name: 'IDX_product_sku')]
#[ORM\Index(columns: ['price'], name: 'IDX_product_price')]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, columnDefinition: 'CHAR(36) NOT NULL')]
    private ?string $id;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $name;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $sku;

    #[ORM\Column(type: Types::FLOAT, precision: 8, scale: 2)]
    private ?float $price;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->createdAt = new \DateTime('now');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
