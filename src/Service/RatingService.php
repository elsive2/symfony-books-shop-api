<?php

namespace App\Service;

use App\Model\Rating;
use App\Repository\ReviewRepository;

class RatingService
{
    public function __construct(
        private ReviewRepository $reviewRepository
    ) { }

    public function calulateRatingForBook(int $id): Rating
    {
        $total = $this->reviewRepository->countByBookId($id);
        $rating = $total > 0 ? $this->reviewRepository->getBookTotalRatingSum($id) / $total : 0; 
    
        return new Rating($total, $rating);
    }
}