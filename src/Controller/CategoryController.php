<?php

namespace App\Controller;

use App\Model\CategoryListResponse;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\ErrorResponse;

#[Route('/api/v1')]
class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService 
    ) { }

    /**
     * @Response(
     *  response=200,
     *  description="Return book categories",
     *  @Model(type=CategoryListResponse::class)
     * )
     * @Response(
     *  response=400,
     *  description="Validation failed",
     *  @Model(type=ErrorResponse::class)
     * )
     */
    #[Route('/categories', name: 'category_index', methods: ['GET'])]
    public function indexAction(): JsonResponse
    {
        $categories = $this->categoryService->getCategories();

        return $this->json($categories);
    }
}
