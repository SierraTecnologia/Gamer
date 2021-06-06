<?php

namespace Gamer\Models;

use Pedreiro\Models\Base;

class Meta extends Base
{
    protected $table = 'metas';
    
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
        'metaable_type',
        'metaable_id',
        'meta_type_id'
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
        'metaable_type' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'metaable_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'meta_type_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'metaable');
    }

    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Telefonica\Models\Actors\Person::class), 'metaable');
    }
}
