<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Faculty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FacultyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Faculty::class);
    }

    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.displayOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }
}