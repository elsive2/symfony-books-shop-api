<?php

namespace App\Entity;

use App\Repository\BookToBookFormatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookToBookFormatRepository::class)]
class BookToBookFormat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $discount = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'formats')]
    private Book $book;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: BookFormat::class, fetch: 'EAGER')]
    private BookFormat $format;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getBook()
    {
        return $this->book;
    }

    /**
     * @return  self
     */ 
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return  self
     */ 
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }
}
