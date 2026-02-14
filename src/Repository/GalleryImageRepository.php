<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\GalleryImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GalleryImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GalleryImage::class);
    }

    public function findByCategory(?string $category = null): array
    {
        $qb = $this->createQueryBuilder('g');
        
        if ($category) {
            $qb->where('g.category = :category')
               ->setParameter('category', $category);
        }
        
        return $qb->getQuery()->getResult();
    }
}