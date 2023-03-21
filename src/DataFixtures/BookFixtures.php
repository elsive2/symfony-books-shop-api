<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $androidCategory = $this->getReference(CategoryFixture::ANDROID_CATEGORY);
        $dataCategory = $this->getReference(CategoryFixture::DATA_CATEGORY);
        $networkCategory = $this->getReference(CategoryFixture::NETWORK_CATEGORY);
        
        $books = [
            (new Book)
                ->setTitle('Rxjava for Android Developers')
                ->setPublicationDate(new \DateTimeImmutable('2019-04-19'))
                ->setMeap(false)
                ->setAuthors(['Timo Tuominen'])
                ->setSlug('rxjava-for-android-developers')
                ->addCategory($androidCategory)
                ->addCategory($dataCategory)
                ->setImage('https://books.google.kz/books/publisher/content?id=ajszEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&imgtk=AFLRE738uMOnevzEu8ZAN2Lrxzn__9nXAlhNqgGI5vBOUmBtl41J1Zm8khFCJXI06VNN7I3Gfsm-he9kjZ9SyDZZBLNJ3gHj0T79v23wTkdAj_7-CYnXbhqNWb3voTE8L6eFz9f3qIn8')
        ];

        foreach ($books as $book) {
            $manager->persist($book);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixture::class
        ];
    }
}
