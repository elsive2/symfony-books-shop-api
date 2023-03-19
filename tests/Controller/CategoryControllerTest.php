<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use App\Tests\AbstractControllerTest;

class CategoryControllerTest extends AbstractControllerTest
{
    public function testIndexAction(): void
    {
        $this->em->persist((new Category)->setTitle('Devices')->setSlug('devices'));
        $this->em->flush();

        $this->client->request('GET', '/api/v1/categories');
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
                        'required' => ['id', 'title', 'slug'],
                        'properties' => [
                            'title' => [
                                'type' => 'string'
                            ],
                            'slug' => [
                                'type' => 'string'
                            ],
                            'id' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}