<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Property as PropertyAlias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PropertyAlias|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyAlias|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyAlias[]    findAll()
 * @method PropertyAlias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[]
     */
    public function findAllVisible() {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

    }

    /**
     * @return Property[]
     */
    public function findLatest():array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');

    }

    }


    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
