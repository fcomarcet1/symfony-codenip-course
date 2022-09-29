<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Index(columns: ['sku'], name: 'IDX_product_sku')]
#[ORM\Index(columns: ['price'], name: 'IDX_product_price')]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, columnDefinition: 'CHAR(36) NOT NULL')]
    private string $id;

    #[Assert\NotBlank(message: 'Por favor introduce tu nombre.')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Product name has to be at least {{ limit }} characters',
        maxMessage: 'Product name has to be maximum {{ limit }} characters'
    )]
    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $name;

    #[Assert\NotBlank(message: 'Por favor introduce el sku.')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Product sku has to be at least {{ limit }} characters',
        maxMessage: 'Product sku has to be maximum {{ limit }} characters'
    )]
    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $sku;

    #[Assert\NotBlank(message: 'Por favor introduce un precio.')]
    #[Assert\PositiveOrZero(message: 'El precio debe ser positivo o cero.')]
    #[ORM\Column(type: Types::INTEGER, precision: 8, scale: 2)]
    private ?int $price;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createdAt;

    #[Assert\NotBlank(message: 'Por favor introduce una categoria.')]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category;

    public function __construct()
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->createdAt = new \DateTime('now');
    }

    public function __toString() {
        return $this->name;
    }

    public function getId(): string
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}
