<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\BookToBookFormat;
use App\Entity\Category;
use App\Exception\CategoryNotFoundException;
use App\Model\BookDetails;
use App\Model\BookFormat;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Model\CategoryListItem;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\Collection;

class BookService
{    
    /**
     * __construct
     *
     * @param CategoryRepository
     * @param BookRepository
     */
    public function __construct(
        private CategoryRepository $categoryRepository,
        private BookRepository $bookRepository,
        private ReviewRepository $reviewRepository
    ) { }
    
    public function getBooksByCategoryId(int $categoryId): BookListResponse
    {
        if (!$this->categoryRepository->existsById($categoryId)) {
            throw new CategoryNotFoundException;
        }

        return new BookListResponse(array_map(
            [$this, 'map'],
            $this->bookRepository->getBooksByCategoryId($categoryId)
        ));
    }

    public function getBookById(int $id): BookDetails
    {
        $book = $this->bookRepository->getById($id);
        $reviews = $this->reviewRepository->countByBookId($id);
        $rating = $this->reviewRepository->getBookTotalRatingSum($id);

        $formats = $this->mapFormats($book->getFormats());

        $categories = $book->getCategories()
            ->map(
                fn (Category $category) => (new CategoryListItem(
                    $category->getId(),
                    $category->getTitle(),
                    $category->getSlug()
                ))
            );

        return (new BookDetails)
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setSlug($book->getSlug())
            ->setMeap($book->getMeap())
            ->setAuthors($book->getAuthors())
            ->setImage($book->getImage())
            ->setPublicationDate($book->getPublicationDate()->getTimestamp())
            ->setRating($rating / $reviews)
            ->setReviews($reviews)
            ->setFormats($formats)
            ->setCategories($categories->toArray());
    }

    private function mapFormats(Collection $formats): array
    {
        return $formats->map(
            fn (BookToBookFormat $formatJoin) => (new BookFormat)
                ->setTitle($formatJoin->getFormat()->getTitle())
                ->setDescription($formatJoin->getFormat()->getTitle())
                ->setComment($formatJoin->getFormat()->getComment())
                ->setId($formatJoin->getFormat()->getId())
                ->setPrice($formatJoin->getPrice())
                ->setDiscount($formatJoin->getDiscount())
        )->toArray();
    }

    private function map(Book $book): BookListItem
    {
        return (new BookListItem)
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setSlug($book->getSlug())
            ->setMeap($book->getMeap())
            ->setAuthors($book->getAuthors())
            ->setImage($book->getImage())
            ->setPublicationDate($book->getPublicationDate()->getTimestamp());
    }
}