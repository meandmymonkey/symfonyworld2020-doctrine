<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TaskList;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskList::class);
    }

    public function findListsOwnedBy(User $owner)
    {
        $dql = <<<DQL
            SELECT task_list
            FROM App\Entity\TaskList task_list
            WHERE task_list.owner = :owner
        DQL;

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('owner', $owner)
            ->getResult();
    }

    public function findArchived(User $owner)
    {
        return $this->createQueryBuilder('task_list')
            ->andWhere('task_list.archived = true AND task_list.owner = :owner')
            ->setParameter('owner', $owner)
            ->getQuery()
            ->getResult();
    }

    public function findActive(User $owner)
    {

    }
}