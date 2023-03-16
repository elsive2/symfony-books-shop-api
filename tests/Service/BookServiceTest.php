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
use App\Tests\AbstractTestCase;

class BookServiceTest extends AbstractTestCase
{
    public function testGetBooksByCategoryNotFound(): void
    {
        $bookRepository = $this->createMock(BookRepository::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);

        $categoryRepository->expects($this->once())
            ->method('find')
            ->with(130)
            ->willThrowException(new CategoryNotFoundException);

        $this->expectException(CategoryNotFoundException::class);

        (new BookService($categoryRepository, $bookRepository))
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
            ->method('find')
            ->with(130)
            ->willReturn(new Category);

        $service = new BookService($categoryRepository, $bookRepository);
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
            ->setPublicationDate(new \DateTime('2005-04-21'))
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
            ->setPublicationDate((new \DateTime('2005-04-21'))->getTimestamp());
    }
}