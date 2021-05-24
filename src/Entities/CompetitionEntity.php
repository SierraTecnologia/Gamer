<?php

namespace Gamer\Entities;

use Gamer\Models\Competition;

class CompetitionEntity extends AbstractEntity
{
    protected $model = Competition::class;

    private $id;
    private $name;
    private $external = [
        'pointagram' => null,
    ];

    /**
     * CompetitionEntity constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if (isset($attributes['id']) && !is_null($attributes['id'])) {
            $this->setId($attributes['id']);
        }
        if (isset($attributes['name']) && !is_null($attributes['name'])) {
            $this->setName($attributes['name']);
        }
    }

    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): CompetitionEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName($value): void
    {
        $this->name = $value;
    }
    public function getExternal(string $service)
    {
        return $this->external[$service];
    }
    public function setExternal(string $service, $value): void
    {
        $this->external[$service] = $value;
    }
    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $data = [
            'name' => $this->getName(),
        ];

        if (!is_null($this->getId())) {
            $data['id'] = $this->getId();
        }
        
        return $data;
    }
}
