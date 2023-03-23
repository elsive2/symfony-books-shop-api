<?php

namespace App\Service;

use App\Entity\Review;
use App\Exception\BookNotFoundException;
use App\Model\Review as ReviewModel;
use App\Model\ReviewPage;
use App\Repository\BookRepository;
use App\Repository\ReviewRepository;

class ReviewService
{
    private const PAGE_LIMIT = 5;
    
    public function __construct(
        private ReviewRepository $reviewRepository,
        private BookRepository $bookRepository,
        private RatingService $ratingService
    ) { }

    public function getReviewPageByBookId(int $id, int $page): ReviewPage
    {
        if (!$this->bookRepository->existsById($id)) {
            throw new BookNotFoundException;
        }

        $offset = max($page - 1, 0) * self::PAGE_LIMIT;
        $paginator = $this->reviewRepository->getPageByBookId($id, $offset, self::PAGE_LIMIT);
        $total = count($paginator);
        $rating = $this->ratingService->calulateRatingForBook($id);

        return (new ReviewPage)
            ->setRating($rating->getRating())
            ->setTotal($total)
            ->setPage($page)
            ->setPerPage(self::PAGE_LIMIT)
            ->setPages(ceil($total / self::PAGE_LIMIT))
            ->setItems(array_map([$this, 'map'], iterator_to_array($paginator->getIterator())));
    }

    private function map(Review $review): ReviewModel
    {
        return (new ReviewModel)
            ->setId($review->getId())
            ->setRating($review->getRating())
            ->setCreatedAt($review->getPublicationDate()->getTimestamp())
            ->setAuthor($review->getAuthor())
            ->setContent($review->getContent());
    }
}