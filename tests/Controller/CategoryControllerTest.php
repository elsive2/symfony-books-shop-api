<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testCategories(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/categories');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/responses/BookCategoryControllerTest_testCategories.json',
            $responseContent
        );
    }
}