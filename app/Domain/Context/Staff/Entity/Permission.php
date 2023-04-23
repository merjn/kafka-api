<?php

declare(strict_types=1);

namespace App\Domain\Context\Staff\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "permissions")]
class Permission
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[OneToMany(mappedBy: "permission", targetEntity: User::class)]
    #[JoinColumn(name: "id", referencedColumnName: "rank_id")]
    private iterable $users;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getUsers(): iterable
    {
        return $this->users;
    }
}
