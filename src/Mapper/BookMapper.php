<?php

namespace App\Mapper;

use App\Entity\Book;
use App\Model\BookDetails;
use App\Model\BookListItem;

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
}