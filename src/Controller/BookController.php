<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\BookListResponse;
use App\Model\ErrorResponse;

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
     * @Response(
     *  response=404,
     *  description="Category not found",
     *  @Model(type=ErrorResponse::class)
     * )
     */
    #[Route('/category/{id}/books', name: 'book_index', methods: ['GET'])]
    public function bookByCategoryAction(int $id): JsonResponse
    {
        return $this->json($this->bookService->getBooksByCategoryId($id));
    }
}
