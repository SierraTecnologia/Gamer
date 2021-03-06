<?php

namespace Gamer\Entities;

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
            $this->setEmail($attributes['email']);
        }
        if (isset($attributes['emailaddress']) && !is_null($attributes['emailaddress'])) {
            $this->setEmail($attributes['emailaddress']);
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
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $value): void
    {
        $this->email = $value;
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
            'email' => $this->getEmail(),
        ];

        if (!is_null($this->getId())) {
            $data['id'] = $this->getId();
        }
        
        return $data;
    }
}
