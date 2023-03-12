<?php

namespace App\Service;

use App\Entity\Category;
use App\Model\CategoryListItem;
use App\Model\CategoryListResponse;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Criteria;

class CategoryService
{    
    /**
     * __construct
     *
     * @param CategoryRepository
     */
    public function __construct(
        private CategoryRepository $categoryRepository
    ) { }
    
    /**
     * getCategories
     *
     * @return CategoryListResponse
     */
    public function getCategories()
    {
        $categories = $this->categoryRepository->findBy([], ['title' => Criteria::ASC]);

        $items = array_map(
            fn (Category $category) => new CategoryListItem(
                $category->getId(),
                $category->getTitle(),
                $category->getSlug()
            ),
            $categories
        );

        return new CategoryListResponse($items);
    }
}