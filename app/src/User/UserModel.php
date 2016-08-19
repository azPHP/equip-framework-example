<?php
namespace Example\User;

use Equip\Data\EntityInterface;
use Equip\Data\Traits\EntityTrait;

class UserModel implements EntityInterface
{
    use EntityTrait;

    // only defined properties can be set
    protected $username;
    protected $name;
}
