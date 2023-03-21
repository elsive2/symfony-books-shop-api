<?php

namespace App\Model;
use App\Entity\Category;

class BookDetails
{
    private int $id;

    private string $title;
    
    private string $slug;
    
    private string $image;
    
    /**
     * @var string[]
     */
    private array $authors;
    
    private bool $meap;
    
    private int $publicationDate;

    private float $rating;

    private int $reviews;

    /**
     * @var CategoryListItem[]
     */
    private array $categories;

    /**
     * @var BookFormat[]
     */
    private array $formats;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     *
     * @return self
     */
    public function setAuthors(array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @return bool
     */
    public function getMeap(): bool
    {
        return $this->meap;
    }

    /**
     * @param bool $meap
     *
     * @return self
     */
    public function setMeap(bool $meap): self
    {
        $this->meap = $meap;

        return $this;
    }

    /**
     * @return int
     */
    public function getPublicationDate(): int
    {
        return $this->publicationDate;
    }

    /**
     * @param int $publicationDate
     *
     * @return self
     */
    public function setPublicationDate(int $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of reviews
     */ 
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Set the value of reviews
     *
     * @return  self
     */ 
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get the value of categories
     *
     * @return  CategoryListItem[]
     */ 
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set the value of categories
     *
     * @param  CategoryListItem[]  $categories
     *
     * @return  self
     */ 
    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get the value of formats
     *
     * @return  BookFormat[]
     */ 
    public function getFormats()
    {
        return $this->formats;
    }

    /**
     * Set the value of formats
     *
     * @param  BookFormat[]  $formats
     *
     * @return  self
     */ 
    public function setFormats(array $formats)
    {
        $this->formats = $formats;

        return $this;
    }
}
