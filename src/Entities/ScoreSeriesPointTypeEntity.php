<?php

namespace Gamer\Entities;

use Gamer\Models\ScoreSeriesPointType;

class ScoreSeriesPointTypeEntity extends AbstractEntity
{
    protected $model = ScoreSeriesPointType::class;

    private $id;
    private $external = [
        'pointagram' => null,
    ];

    /**
     * ScoreSeriesPointTypeEntity constructor.
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
    private function setId(int $id): ScoreSeriesPointTypeEntity
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
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
