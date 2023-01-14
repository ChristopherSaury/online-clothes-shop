<?php

namespace App\Repository;

use App\Entity\Clothes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Clothes>
 *
 * @method Clothes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clothes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clothes[]    findAll()
 * @method Clothes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clothes::class);
    }

    public function save(Clothes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Clothes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllHeadwear(ItemCategoryRepository $category, $filter_colors = null,
    $filter_category = null, $filter_sort = null){
        $id = $category->getHeadwearCatId();
        $query = $this->createQueryBuilder('c');
        if($filter_category !== null){
            $query->andWhere('c.category IN(:cats)')
            ->setParameter(':cats', array_values($filter_category));
        }else{
            $query->andWhere('c.category IN(:cats)')
            ->setParameter(':cats', array_values($id));
        }

        if($filter_colors !== null){
            $query->andWhere('c.color IN(:col)')
            ->setParameter(':col', array_values($filter_colors));
        }

        if($filter_sort == 'LowToHigh'){
            $query->orderBy('c.price', 'ASC');
        }elseif($filter_sort == 'HighToLow'){
            $query->orderBy('c.price', 'DESC');
        }elseif($filter_sort == 'AtoZ'){
            $query->orderBy('c.model', 'ASC');
        }elseif($filter_sort == 'ZtoA'){
            $query->orderBy('c.model', 'DESC');
        }
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Clothes[] Returns an array of Clothes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Clothes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
