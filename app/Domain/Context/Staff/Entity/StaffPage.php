<?php

declare(strict_types=1);

namespace App\Domain\Context\Staff\Entity;

use App\Domain\Attributes\AggregateRoot;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[AggregateRoot]
#[Entity]
#[Table(name: "kafka_permission_staff_page")]
class StaffPage
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'integer')]
    private int $order;

    #[OneToOne(targetEntity: Permission::class)]
    #[JoinColumn(name: "permission_id", referencedColumnName: "id")]
    private Permission $permission;

    public function __construct(string $name, int $order, Permission $permission)
    {
        $this->name = $name;
        $this->order = $order;
        $this->permission = $permission;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    public function getStaffMembers(): iterable
    {
        return $this->permission->getUsers();
    }
}
