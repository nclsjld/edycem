<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getCountUsers()
    {
        return $this->_em->createQueryBuilder()
            ->select('COUNT(u)')
            ->from($this::getEntityName(), 'u')
            ->where('u.roles LIKE :roleUser')
            ->orWhere('u.roles NOT LIKE :roleOther')
            ->setParameter('roleUser', '%ROLE_USER%')
            ->setParameter('roleOther', '%ROLE_%')
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleScalarResult();
    }

    public function findAllWithFields($fields = 'user', $where = '1 = 1')
    {
        return $this->_em->createQueryBuilder()
            ->select($fields)
            ->from($this::getEntityName(), 'user')
            ->leftJoin('user.job', 'job')
            ->where($where)
            ->getQuery()
            ->getResult();
    }
}