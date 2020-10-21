<?php

namespace App\Repository;

use App\Entity\Number;
use App\Controller\SearchController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Number|null find($id, $lockMode = null, $lockVersion = null)
 * @method Number|null findOneBy(array $criteria, array $orderBy = null)
 * @method Number[]    findAll()
 * @method Number[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Number::class);
    }

    public function findOneBySomeField($search): ?Number
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    // /**
    //  * @return Number[] Returns an array of Number objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*

    */
}
