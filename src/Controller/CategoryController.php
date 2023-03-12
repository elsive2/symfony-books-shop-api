<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1')]
class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService 
    ) { }

    #[Route('/categories', name: 'category_index')]
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getCategories();

        return $this->json($categories);
    }
}
