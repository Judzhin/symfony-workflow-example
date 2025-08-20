<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

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
     * @param int|null $limit
     * @param int|null $offset
     * @return iterable<int, Post>
     */
    public function findByPublished(?int $limit = null, ?int $offset = null): array
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $root = $queryBuilder->getRootAliases()[0];

        $queryBuilder
            ->where($queryBuilder->expr()->eq(sprintf('%s.type', $root), ':type'))
            ->setParameter('type', Post::TYPE_PUBLISHED);

        $queryBuilder
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->addOrderBy(new OrderBy(sprintf('%s.publishedAt', $root), Order::Descending->value));

        return $queryBuilder->getQuery()->getResult();
    }
}
