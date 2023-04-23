<?php

declare(strict_types=1);

namespace App\Domain\Context\Team\Entity;

use App\Domain\Attributes\AggregateRoot;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[AggregateRoot]
#[Entity]
#[Table(name: "kafka_team_members")]
class TeamMember
{
    #[Id]
    private int $id;

    #[Column(type: 'string')]
    private string $name;

    #[OneToOne(targetEntity: Permission::class)]
    #[JoinColumn(name: "permission_id", referencedColumnName: "id")]
    private Permission $permission;

    public function __construct(string $name, Permission $permission)
    {
        $this->name = $name;
        $this->permission = $permission;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
