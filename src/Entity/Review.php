<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(type: "date_immutable")]
    private DateTimeInterface $publicationDate;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    private Book $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
    
    #[ORM\PrePersist]
    public function setPublicationDate()
    {
        $this->publicationDate = new \DateTimeImmutable;
    }

    public function getPublicationDate(): DateTimeInterface
    {
        return $this->publicationDate;
    }

    /**
     * @return Book
     */ 
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
}
