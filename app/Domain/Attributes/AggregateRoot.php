<?php

namespace App\Domain\Attributes;

use Attribute;

/**
 * This attribute does not have any behavior. It just indicates to the reader that an entity is an aggregate
 * root and should therefore be treated as an aggregate root.
 */
#[Attribute]
class AggregateRoot
{

}
