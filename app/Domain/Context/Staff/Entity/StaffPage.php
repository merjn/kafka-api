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

    #[Column(name: 'page_order', type: 'integer')]
    private int $pageOrder;

    #[OneToOne(targetEntity: Permission::class)]
    #[JoinColumn(name: "permission_id", referencedColumnName: "id")]
    private Permission $permission;

    public function __construct(string $name, int $pageOrder, Permission $permission)
    {
        $this->name = $name;
        $this->pageOrder = $pageOrder;
        $this->permission = $permission;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPageOrder(): int
    {
        return $this->pageOrder;
    }

    public function getStaffMembers(): iterable
    {
        return $this->permission->getUsers();
    }
}
