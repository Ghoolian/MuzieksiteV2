<?php

namespace App\Repository;

use App\Entity\Number;
use App\Controller\SearchController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


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

    public function findNumbersBySearch(string $searchvalue): array
    {
        // "N" is een alias die wordt gebruikt voor de rest van de query.
        $qb = $this->createQueryBuilder('n')
            ->where('n.Name LIKE :searchvalue')
            ->setParameter('Name', '%'.$searchvalue.'%')
            ->orderBy('n.Name', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();
    }

//    Old search function
//    public function getSearch()
//    {
//        $entityManager = $this->getEntityManager();
//
//        $query = $entityManager->createQuery(
//            'SELECT n.Name
//            FROM App\Entity\Number n
//            ORDER BY n.Name ASC');
//            return $query->getArrayResult();
//    }
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
