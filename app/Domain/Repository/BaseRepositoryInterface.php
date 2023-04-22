<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryInterface;

interface BaseRepositoryInterface extends EntitySpecificationRepositoryInterface
{
    public function persist(object $entity): void;
}
