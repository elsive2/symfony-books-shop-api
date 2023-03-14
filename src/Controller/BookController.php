<?php

namespace App\Controller;

use App\Exception\CategoryNotFoundException;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\BookListResponse;
use OpenApi\Annotations\Response;
use Nelmio\ApiDocBundle\Annotation\Model;

//TODO: Make a general prefix
#[Route('/api/v1')]
class BookController extends AbstractController
{
    public function __construct(
        private BookService $bookService
    ) { }

    /**
     * @Response(
     *  response=200,
     *  description="Return books by category id",
     *  @Model(type=BookListResponse::class)
     * )
     */
    #[Route('/category/{id}/books', name: 'book_index', methods: ['GET'])]
    public function bookByCategoryAction(int $id): JsonResponse
    {
        try {
            return $this->json($this->bookService->getBooksByCategoryId($id));
        } catch (CategoryNotFoundException $e) {
            throw new HttpException($e->getCode(), $e->getMessage());
        }
    }
}
