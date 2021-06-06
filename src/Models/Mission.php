<?php

namespace Gamer\Models;

use Pedreiro\Models\Base;

class Mission extends Base
{
    protected $table = 'missions';
    
    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'missionable_type',
        'missionable_id',
        'mission_type_id'
    ];
    public $formFields = [
        ['name' => 'code', 'label' => 'Code', 'type' => 'text'],
        ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
    ];
    public $indexFields = [
        'code',
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
        'missionable_type' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'missionable_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'mission_type_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'missionable');
    }

    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Telefonica\Models\Actors\Person::class), 'missionable');
    }
}
