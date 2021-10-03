<?php

namespace Gamer\Models;

use Gamer\Builders\QuestionBuilder;
use App\Contants\Tables;
use Gamer\Entities\QuestionEntity;
use Illuminate\Database\Eloquent\Collection;
use Pedreiro\Models\Base;
use Siravel\Models\Blog\Post;

/**
 * Class Question.
 *
 * @property int id
 * @property string value
 * @property Collection responses
 * @package  App\Models
 */
class Question extends Base
{
    public static $classeBuilder = QuestionBuilder::class;
    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        // Pergunta a ser Feita
        'question',

        // Tipo de Pergunta
        // Ex: seguranca, espectativa, gosto, 
        'type',

        // Tipo de Resposta
        // text, bool, input
        'options',

        'perpective',
        'perpective_reference',

        'relation',
    ];
    public $formFields = [
        ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
    ];
    public $indexFields = [
        'name',
        'description',
    ];

    /**
     * Retorna Todos os Requisitos para que essa Pergunta possa ser feita!
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requisitos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * Retorna o Skill e um Numero entre 0 e 1 para esse Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses()
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function (self $question) {
                $question->responses()->detach();
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): QuestionBuilder
    {
        return new QuestionBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): QuestionBuilder
    {
        return parent::newQuery();
    }

    /**
     * Setter for the 'value' attribute.
     *
     * @param  string $value
     * @return $this
     */
    public function setValueAttribute(string $value)
    {
        $this->attributes['value'] = trim(str_replace(' ', '_', strtolower($value)));

        return $this;
    }

    /**
     * @return QuestionEntity
     */
    public function toEntity(): QuestionEntity
    {
        return new QuestionEntity(
            [
            'id' => $this->id,
            'value' => $this->value,
            ]
        );
    }
}
