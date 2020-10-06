<?php
namespace App\Reactors;

use App\Events\MoneyAdded;

class BigAmountAddedReactor
{
    /*
     * Here you can specify which event should trigger which method.
     */
    protected array $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',

    ];

    public function onMoneyAdded(MoneyAdded $event)
    {
        // do some work
    }
}
