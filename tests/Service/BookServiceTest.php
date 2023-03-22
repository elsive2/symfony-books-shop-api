<?php

namespace App\Tests\Service;

use App\Entity\Book;
use App\Exception\CategoryNotFoundException;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Service\BookService;
use App\Entity\Category;
use App\Repository\ReviewRepository;
use App\Service\RatingService;
use App\Tests\AbstractTestCase;

class BookServiceTest extends AbstractTestCase
{
    public function testGetBooksByCategoryNotFound(): void
    {
        $bookRepository = $this->createMock(BookRepository::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);

        $categoryRepository->expects($this->once())
            ->method('existsById')
            ->with(130)
            ->willReturn(false);

        $reviewRepository = $this->createMock(ReviewRepository::class);
        $ratingService = $this->createMock(RatingService::class);

        $this->expectException(CategoryNotFoundException::class);

        (new BookService($categoryRepository, $bookRepository, $reviewRepository, $ratingService))
            ->getBooksByCategoryId(130); 
    }

    public function testGetBooksByCategory()
    {
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('getBooksByCategoryId')
            ->with(130)
            ->willReturn([$this->createBookEntity()]);

        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository->expects($this->once())
            ->method('existsById')
            ->with(130)
            ->willReturn(true);

        $reviewRepository = $this->createMock(ReviewRepository::class);
        $ratingService = $this->createMock(RatingService::class);

        $service = new BookService($categoryRepository, $bookRepository, $reviewRepository, $ratingService);
        $actual = $service->getBooksByCategoryId(130);
        $expected = new BookListResponse([$this->createBookItemModel()]);

        $this->assertEquals($expected, $actual);
    }

    private function createBookEntity()
    {
        $book = (new Book)
            ->setTitle('Test')
            ->setSlug('test')
            ->setMeap(false)
            ->setAuthors(['Some author'])
            ->setImage('image.jpg')
            ->setPublicationDate(new \DateTimeImmutable('2005-04-21'))
            ->setDescription('Test description')
            ->setIsbn('12345678910')
            ->addCategory(new Category);

        $this->setEntityId($book, 130);
        return $book;
    }

    private function createBookItemModel(): BookListItem
    {
        return (new BookListItem)
            ->setId(130)
            ->setTitle('Test')
            ->setSlug('test')
            ->setMeap(false)
            ->setAuthors(['Some author'])
            ->setImage('image.jpg')
            ->setPublicationDate((new \DateTimeImmutable('2005-04-21'))->getTimestamp());
    }
}