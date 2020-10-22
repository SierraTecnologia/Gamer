<?php

namespace Gamer\Builders;

use App\Contants\Tables;
use Gamer\Entities\UserEntity;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RoleBuilder.
 *
 * @package Gamer\Builders
 */
class RoleBuilder extends Builder
{
    /**
     * @var string
     */
    private $rolesTable = Tables::TABLE_ROLES;

    /**
     * @return $this
     */
    public function whereNameCustomer()
    {
        return $this->where("{$this->rolesTable}.name", UserEntity::ROLE_CUSTOMER);
    }

    /**
     * @return $this
     */
    public function whereNameAdministrator()
    {
        return $this->where("{$this->rolesTable}.name", UserEntity::ROLE_ADMINISTRATOR);
    }
}
