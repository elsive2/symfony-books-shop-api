<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\BookToBookFormat;
use App\Entity\Category;
use App\Exception\CategoryNotFoundException;
use App\Mapper\BookMapper;
use App\Model\BookDetails;
use App\Model\BookFormat;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Model\CategoryListItem;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Repository\ReviewRepository;
use App\Service\Recommendation\Model\RecommendationItem;
use App\Service\Recommendation\RecommendationService;
use Doctrine\Common\Collections\Collection;
use Psr\Log\LoggerInterface;

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
        private ReviewRepository $reviewRepository,
        private RatingService $ratingService,
        private RecommendationService $recommendationService,
        private LoggerInterface $logger
    ) { }
    
    public function getBooksByCategoryId(int $categoryId): BookListResponse
    {
        if (!$this->categoryRepository->existsById($categoryId)) {
            throw new CategoryNotFoundException;
        }

        return new BookListResponse(array_map(
            fn (Book $book) => BookMapper::map($book, new BookListItem),
            $this->bookRepository->getBooksByCategoryId($categoryId)
        ));
    }

    public function getBookById(int $id): BookDetails
    {
        $book = $this->bookRepository->getById($id);
        $reviews = $this->reviewRepository->countByBookId($id);
        $rating = $this->ratingService->calulateRatingForBook($id, $reviews);
        $formats = $this->mapFormats($book->getFormats());
        $recommendations = [];

        $categories = $book->getCategories()
            ->map(
                fn (Category $category) => (new CategoryListItem(
                    $category->getId(),
                    $category->getTitle(),
                    $category->getSlug()
                ))
            );

        try {
            $recommendations = $this->getRecommendations($id);
        } catch (\Exception $ex) {
            $this->logger->error('error while fetching recommendations', [
                'exception' => $ex->getMessage(),
                'bookId' => $id
            ]);
        }

        return BookMapper::map($book, new BookDetails)
            ->setRating($rating)
            ->setRecommendations($recommendations)
            ->setReviews($reviews)
            ->setFormats($formats)
            ->setCategories($categories->toArray());
    }

    private function getRecommendations(int $bookId): array
    {
        $ids = array_map(
            fn (RecommendationItem $item) => $item->getId(),
            $this->recommendationService->getRecommendationsByBookId($bookId)->getRecommendations()
        );

        return array_map([BookMapper::class, 'mapRecommended'], $this->bookRepository->findBooksByIds($ids));
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
}