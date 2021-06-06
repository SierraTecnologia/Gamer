<?php

namespace Gamer\Entities;

use Gamer\Models\Team;

class TeamEntity extends AbstractEntity
{
    protected $model = Team::class;

    private $id;
    private $name;
    private $icon;
    private $external = [
        'pointagram' => null,
    ];

    /**
     * TeamEntity constructor.
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
        if (isset($attributes['icon']) && !is_null($attributes['icon'])) {
            $this->setIcon($attributes['icon']);
        }
    }

    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): TeamEntity
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
    public function getName()
    {
        return $this->name;
    }
    public function setName($value): void
    {
        $this->name = $value;
    }
    public function getIcon()
    {
        return $this->icon;
    }
    public function setIcon($value): void
    {
        $this->icon = $value;
    }
    public function getExternal(string $service): string
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
            'icon' => $this->getIcon(),
        ];

        if (!is_null($this->getId())) {
            $data['id'] = $this->getId();
        }
        
        return $data;
    }
}
