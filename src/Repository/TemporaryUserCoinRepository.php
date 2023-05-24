<?php

namespace App\Repository;

use App\Entity\TemporaryUserCoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemporaryUserCoin>
 *
 * @method TemporaryUserCoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemporaryUserCoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemporaryUserCoin[]    findAll()
 * @method TemporaryUserCoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemporaryUserCoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemporaryUserCoin::class);
    }

    public function save(TemporaryUserCoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TemporaryUserCoin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TemporaryUserCoin[] Returns an array of TemporaryUserCoin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TemporaryUserCoin
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
