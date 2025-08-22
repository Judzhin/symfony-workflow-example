<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string|null $root
     * @return void
     */
    public static function applyPublishedAtCriteria(QueryBuilder $queryBuilder, ?string $root = null): void
    {
        $root = $root ?? $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->where($queryBuilder->expr()->eq(sprintf('%s.type', $root), ':type'))
            ->andWhere($queryBuilder->expr()->lte(sprintf('%s.publishedAt', $root), ':publishedAt'))
            ->setParameter('type', Post::TYPE_PUBLISHED)
            ->setParameter('publishedAt', new \DateTime);
    }

    /**
     * @return QueryBuilder
     */
    private function createPublishedQueryBuilder(): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $root = $queryBuilder->getRootAliases()[0];
        self::applyPublishedAtCriteria($queryBuilder, $root);

        $queryBuilder
            ->addOrderBy(new OrderBy(sprintf('%s.publishedAt', $root), Order::Descending->value));

        return $queryBuilder;
    }

    /**
     * @return Pagerfanta
     */
    public function findPublished(): Pagerfanta
    {
        $queryBuilder = $this->createPublishedQueryBuilder();

        // $queryBuilder = $this->createQueryBuilder('p');
        //
        // $root = $queryBuilder->getRootAliases()[0];
        // self::applyPublishedAtCriteria($queryBuilder, $root);
        //
        // $queryBuilder
        //     ->addOrderBy(new OrderBy(sprintf('%s.publishedAt', $root), Order::Descending->value));

        return new Pagerfanta(new QueryAdapter($queryBuilder->getQuery()));
    }

    /**
     * @param Category $category
     * @return Pagerfanta
     */
    public function findPublishedByCategory(Category $category): Pagerfanta
    {
        $queryBuilder = $this->createPublishedQueryBuilder();

        $queryBuilder
            ->andWhere($queryBuilder->expr()->eq('p.category', ':category'))
            ->setParameter('category', $category);

        return new Pagerfanta(new QueryAdapter($queryBuilder->getQuery()));
    }

    /**
     * @param Category $category
     * @return int
     */
    public function countPublishedBy(Category $category): int
    {
        $queryBuilder = $this
            ->createQueryBuilder('p')
            ->select('COUNT(p.id)');

        self::applyPublishedAtCriteria($queryBuilder);

        $queryBuilder
            ->andWhere($queryBuilder->expr()->eq('p.category', ':category'))
            ->setParameter('category', $category);

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }
}
