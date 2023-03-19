<?php

namespace App\Service;

use App\Entity\Book;
use App\Exception\CategoryNotFoundException;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;

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
        private BookRepository $bookRepository
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