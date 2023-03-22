<?php

namespace App\Mapper;

use App\Entity\Book;
use App\Model\BookDetails;
use App\Model\BookListItem;
use App\Model\RecommendedBook;

class BookMapper
{
    /**
     * @param Book
     * @param BookDetails|BookListItem $model
     * @return BookDetails|BookListItem
     */
    public static function map(Book $book, $model)
    {
        return $model
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setSlug($book->getSlug())
            ->setMeap($book->getMeap())
            ->setAuthors($book->getAuthors())
            ->setImage($book->getImage())
            ->setPublicationDate($book->getPublicationDate()->getTimestamp());
    }

    /**
     * @param Book
     * @return RecommendedBook
     */
    public static function mapRecommended(Book $book)
    {
        $description = $book->getDescription();
        $description = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
        
        return (new RecommendedBook)
            ->setId($book->getId())
            ->setImage($book->getImage())
            ->setSlug($book->getSlug())
            ->setTitle($book->getTitle())
            ->setShortDescription($description);
    }
}