<?php 
namespace App\Aggregates;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AccountAggregate extends AggregateRoot
{
    /**
     * @return static
     */
    public function createAccount(string $name, string $userId): self
    {
        $this->recordThat(new AccountCreated($name, $userId));
        
        return $this;
    }

    /**
     * @return static
     */
    public function addMoney(int $amount): self
    {
        $this->recordThat(new MoneyAdded($amount));
        
        return $this;
    }

    /**
     * @return static
     */
    public function subtractAmount(int $amount): self
    {
        $this->recordThat(new MoneySubtracted($amount));
        
        return $this;
    }

    /**
     * @return static
     */
    public function deleteAccount(): self
    {
        $this->recordThat(new AccountDeleted());
        
        return $this;
    }
}