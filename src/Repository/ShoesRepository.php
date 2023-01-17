<?php

namespace App\Repository;

use App\Entity\Shoes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Shoes>
 *
 * @method Shoes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shoes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shoes[]    findAll()
 * @method Shoes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shoes::class);
    }

    public function save(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllShoes($shoes_catId, $filter_colors = null, $filter_sort = null){
        $query = $this->createQueryBuilder('s');
        $query->where('s.category = :shoes_catId')
        ->setParameter(':shoes_catId', $shoes_catId);

        if($filter_colors !== null){
            $query->andWhere('s.color IN(:colors)')
            ->setParameter(':colors', array_values($filter_colors));
        }

        if($filter_sort == 'LowToHigh'){
            $query->orderBy('s.price', 'ASC');
        }elseif($filter_sort == 'HighToLow'){
            $query->orderBy('s.price', 'DESC');
        }elseif($filter_sort == 'AtoZ'){
            $query->orderBy('s.Model', 'ASC');
        }elseif($filter_sort == 'ZtoA'){
            $query->orderBy('s.Model', 'DESC');
        }
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Shoes[] Returns an array of Shoes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Shoes
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
