<?php 
namespace App\Aggregates;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AccountAggregate extends AggregateRoot
{
    public function createAccount(string $name, string $userId)
    {
        $this->recordThat(new AccountCreated($name, $userId));
        
        return $this;
    }

    public function addMoney(int $amount)
    {
        $this->recordThat(new MoneyAdded($amount));
        
        return $this;
    }

    public function subtractAmount(int $amount)
    {
        $this->recordThat(new MoneySubtracted($amount));
        
        return $this;
    }

    public function deleteAccount()
    {
        $this->recordThat(new AccountDeleted());
        
        return $this;
    }
}