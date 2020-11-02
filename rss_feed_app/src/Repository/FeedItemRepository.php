<?php

namespace App\Repository;

use App\Entity\FeedItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FeedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedItem::class);
    }

    public function retrieveFeedsAscending(int $offset = 25): array
    {
        return $this->findBy([], ['pubDate' => 'DESC'], $offset);
    }
}
