<?php

namespace App\Repository;

use App\Entity\Book;
use App\Exception\BookNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param int $categoryId
     * @return Book[]
     */
    public function getBooksByCategoryId(int $categoryId)
    {
        $query = $this->_em->createQuery('SELECT b FROM App\Entity\Book b WHERE :categoryId MEMBER OF b.categories');
        $query->setParameter('categoryId', $categoryId);

        return $query->getResult();
    }

    /**
     * @param int $id
     * @return Book
     */
    public function getById(int $id): Book
    {
        $book = $this->find($id);
        if (null === $book) {
            throw new BookNotFoundException;
        }
        return $book;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function existsById(int $id): bool
    {
        return null !== $this->find($id);
    }

    /**
     * @param int[]
     * @return Book[]
     */
    public function findBooksByIds(array $ids)
    {
        return $this->findBy(['id' => $ids]);
    }
}
