<?php

namespace Gamer\Models;

use Pedreiro\Models\Base;

class Team extends Base
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'icon' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

}
