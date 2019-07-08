<?php

namespace App\Repository;

use App\Entity\Settings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Settings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Settings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Settings[]    findAll()
 * @method Settings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Settings::class);
    }

    public function findAllWithFields($fields = 'settings', $where = '1 = 1')
    {
        return $this->_em->createQueryBuilder()
            ->select($fields)
            ->from($this::getEntityName(), 'settings')
            ->where($where)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();
    }
}
