<?php

declare(strict_types=1);

namespace App\Domain\Context\Staff\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Table(name: "users")]
#[Entity]
class User
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private int $id;

    #[Column(type: 'string')]
    private string $username;

    #[Column(name: 'look', type: 'string')]
    private string $look;

    #[Column(type: 'string')]
    private string $motto;

    #[ManyToOne(targetEntity: Permission::class, inversedBy: 'users')]
    #[JoinColumn(name: "rank", referencedColumnName: "id")]
    private Permission $permission;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getLook(): string
    {
        return $this->look;
    }

    /**
     * @return string
     */
    public function getMotto(): string
    {
        return $this->motto;
    }
}
