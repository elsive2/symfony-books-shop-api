<?php

namespace App\Tests\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Tests\AbstractControllerTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends AbstractControllerTest
{
    public function testBookByCategoryAction(): void
    {
        $categoryId = $this->createCategory();

        $this->client->request('GET', '/api/v1/category/'. $categoryId .'/books');
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema($responseContent, [
            'type' => 'object',
            'required' => ['items'],
            'properties' => [
                'items' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'required' => ['id', 'title', 'slug', 'image', 'authors', 'meap', 'publicationDate'],
                        'properties' => [
                            'id' => [
                                'type' => 'integer'
                            ],
                            'title' => [
                                'type' => 'string'
                            ],
                            'slug' => [
                                'type' => 'string'
                            ],
                            'image' => [
                                'type' => 'string'
                            ],
                            'authors' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'string'
                                ]
                            ],
                            'meap' => [
                                'type' => 'boolean'
                            ],
                            'publicationDate' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    private function createCategory(): int
    {
        $category = (new Category)->setTitle('Devices')->setSlug('devices');
        $this->em->persist($category);

        $this->em->persist((new Book)
            ->setTitle('Test book')
            ->setImage('http://localhost/test.png')
            ->setMeap(true)
            ->setPublicationDate(new \DateTimeImmutable)
            ->setAuthors(['Tester'])
            ->addCategory($category)
            ->setSlug('test-book')
            ->setIsbn('123456789')
            ->setDescription('Some test description'));

        $this->em->flush();

        return $category->getId();
    }
}