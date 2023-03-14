<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public const ANDROID_CATEGORY = 'android';
    public const DATA_CATEGORY = 'data';
    public const NETWORK_CATEGORY = 'network';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::ANDROID_CATEGORY => (new Category)->setTitle('Android')->setSlug('android'),
            self::DATA_CATEGORY => (new Category)->setTitle('Data')->setSlug('data'),
            self::NETWORK_CATEGORY => (new Category)->setTitle('Network')->setSlug('network')
        ];
        
        foreach ($categories as $key => $category) {
            $manager->persist($category);
            $this->addReference($key, $category);
        }
        $manager->flush();
    }
}
