<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllAsArray(): array
    {
        return $this->createQueryBuilder('u')
            ->select('u.name', 'u.email', 'u.username', 'u.address', 'u.role')
            ->getQuery()
            ->getArrayResult();
    }
}