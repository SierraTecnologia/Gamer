<?php

namespace Gamer\Models;

use Pedreiro\Models\Base;

class Team extends Base
{
    public $table = 'gamer_teams';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
    ];
    public $formFields = [
        ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
    ];
    public $indexFields = [
        'name',
        'description',
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
