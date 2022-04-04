<?php

namespace App\Repository;

use App\Entity\Residence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Residence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Residence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Residence[]    findAll()
 * @method Residence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Residence::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Residence $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Residence $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllCity() {

        $temp = $this->createQueryBuilder('Residence')
            ->select('r.city')
            ->from('App\Entity\Residence', 'r')
            ->groupBy('r.city')
            ->getQuery()
            ->getResult();
        $city = [];
        foreach ($temp as $row) {
            $city[] = $row['city'];
        }
        return $city;
    }

    public function findById($id) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByCity(string $city) {

        return $this->createQueryBuilder('r')
            ->andWhere('r.city = :val')
            ->setParameter('val', $city)
            ->getQuery()
            ->getResult();
    }

    public function findByOwner($owner) {

        return $this->createQueryBuilder('r')
            ->andWhere('r.owner = :val')
            ->setParameter('val', $owner)
            ->getQuery()
            ->getResult();
    }

    public function findByRepresentative($representative) {

        return $this->createQueryBuilder('r')
            ->andWhere('r.representative = :val')
            ->setParameter('val', $representative)
            ->getQuery()
            ->getResult();
    }

    public function findAllocatedByCity(string $city) {
        $city = "%$city%";
        $entityManager = $this->getEntityManager();
        $now_date = new \DateTime('now');
        $query = $entityManager->createQuery(
            "SELECT residence
             FROM App\Entity\Residence residence, App\Entity\Rent rent
             WHERE residence.city
             LIKE :city
             AND residence.id = rent.residence
             AND rent.arrival_date < :now
             AND rent.departure_date > :now"
        )->setParameter('now', $now_date)
            ->setParameter('city', $city);

        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return Residence[] Returns an array of Residence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Residence
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
