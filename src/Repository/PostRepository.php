<?php

namespace App\Repository;

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
     * @param int|null $limit
     * @param int|null $offset
     * @return Pagerfanta<int, Post>
     */
    public function findPublished(?int $limit = null, ?int $offset = null): Pagerfanta
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $root = $queryBuilder->getRootAliases()[0];
        self::applyPublishedAtCriteria($queryBuilder, $root);

        $queryBuilder
            // ->setMaxResults($limit)
            // ->setFirstResult($offset)
            ->addOrderBy(new OrderBy(sprintf('%s.publishedAt', $root), Order::Descending->value));

        // return $queryBuilder->getQuery()->getResult();
        return new Pagerfanta(new QueryAdapter($queryBuilder->getQuery()));
    }
}
