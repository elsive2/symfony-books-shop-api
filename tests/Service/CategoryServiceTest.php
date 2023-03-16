<?php

namespace App\Tests\Service;

use App\Entity\Category;
use App\Model\CategoryListItem;
use App\Model\CategoryListResponse;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use App\Tests\AbstractTestCase;
use Doctrine\Common\Collections\Criteria;

class CategoryServiceTest extends AbstractTestCase
{
    public function testGetCategories()
    {
        $category = (new Category())->setTitle('Test')->setSlug('test');
        $this->setEntityId($category, 7);

        $repository = $this->createMock(CategoryRepository::class);
        $repository->expects($this->once())
            ->method('findBy')
            ->with([], ['title' => Criteria::ASC])
            ->willReturn([$category]);

        $service = new CategoryService($repository);
        $expected = new CategoryListResponse([new CategoryListItem(7, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}