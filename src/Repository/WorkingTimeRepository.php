<?php

namespace App\Repository;

use App\Entity\WorkingTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkingTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingTime[]    findAll()
 * @method WorkingTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingTimeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkingTime::class);
    }

    public function findAllWithFields($fields = 'working_time')
    {
        return $this->_em->createQueryBuilder()
            ->select($fields)
            ->from($this::getEntityName(), 'working_time')
            ->getQuery()
            ->getResult();
    }
}
