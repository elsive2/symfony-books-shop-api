<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Category)->setTitle('Android')->setSlug('android'));
        $manager->persist((new Category)->setTitle('Data')->setSlug('data'));
        $manager->persist((new Category)->setTitle('Network')->setSlug('network'));

        $manager->flush();
    }
}
