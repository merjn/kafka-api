<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BaseRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryTrait;
use Happyr\DoctrineSpecification\Result\ResultModifier;

class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{
    use EntitySpecificationRepositoryTrait;

    public function persist(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
