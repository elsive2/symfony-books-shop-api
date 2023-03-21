<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, type: "string")]
    private ?string $title = null;

    #[ORM\Column(length: 255, type: "string")]
    private ?string $slug = null;

    #[ORM\Column(length: 255, type: "string")]
    private ?string $image = null;

    #[ORM\Column(type: "simple_array")]
    private array $authors;

    #[ORM\Column(type: "date_immutable")]
    private DateTimeInterface $publicationDate;

    #[ORM\Column(type: "boolean", options: ['default' => false])]
    private bool $meap;

    #[ORM\Column(length: 13, type: "string")]
    private string $isbn;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'book')]
    private Collection $reviews;

    /**
     * @var Collection<Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class)]
    private Collection $categories;

    /**
     * @var Collection<Category>
     */
    #[ORM\OneToMany(targetEntity: BookToBookFormat::class, mappedBy: 'book')]
    private Collection $formats;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->formats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setAuthors(array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    public function getPublicationDate(): DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getMeap(): bool
    {
        return $this->meap;
    }

    public function setMeap(bool $meap): self
    {
        $this->meap = $meap;

        return $this;
    }

    /**
     * @return Collection<Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn($isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFormats()
    {
        return $this->formats;
    }

    public function addFormat(BookToBookFormat $format)
    {
        if (!$this->formats->contains($format)) {
            $this->formats->add($format);
        }

        return $this;
    }

    /**
     * @return Review[]
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param Review $review
     * @return self
     */
    public function addReview(Review $review)
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
        }

        return $this;
    }
}
