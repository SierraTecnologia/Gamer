<?php

namespace Gamer\Entitys;

use Gamer\Models\Player;

class PlayerEntity extends AbstractEntity
{
    protected $model = Player::class;

    private $id;
    private $name;
    private $email;
    private $external = [
        'pointagram' => null,
    ];

    /**
     * PlayerEntity constructor.
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
        if (isset($attributes['Name']) && !is_null($attributes['Name'])) {
            $this->setName($attributes['Name']);
        }
        if (isset($attributes['email']) && !is_null($attributes['email'])) {
            $this->setName($attributes['email']);
        }
        if (isset($attributes['emailaddress']) && !is_null($attributes['emailaddress'])) {
            $this->setName($attributes['emailaddress']);
        }
    }

    /**
     * @param  int $id
     * @return $this
     */
    private function setId(int $id): PlayerEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $value): void
    {
        $this->email = $value;
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
