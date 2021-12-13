<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findLastByAuthor(Author $author, int $limit = 5): array
    {
        $queryBuilder = $this->createQueryBuilder('article');
        $queryBuilder
            ->where('article.author = :author')
            ->orderBy('article.date', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('author', $author)
        ;

        return $queryBuilder->getQuery()->execute();
    }
}
