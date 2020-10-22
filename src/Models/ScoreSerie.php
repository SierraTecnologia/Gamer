<?php

namespace Gamer\Models;

use Pedreiro\Models\Base;

class ScoreSerie extends Base
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

}
