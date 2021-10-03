<?php 
namespace App\Projectors;

use App\Events\MoneyAdded;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\Facades\Projectionist;
use Spatie\EventSourcing\Models\StoredEvent;

class MetaDataProjector extends Projector
{
    /*
     * Here you can specify which event should trigger which method.
     */
    public array $handlesEvents = [
        MoneyAdded::class => 'onMoneyAdded',
    ];

    public function onMoneyAdded(StoredEvent $storedEvent, StoredEventRepository $repository): void
    {
        if (! Projectionist::isReplaying()) {
            $storedEvent->meta_data['user_id'] = auth()->user()->id;

            $repository->update($storedEvent);
        }
        
        // ...
    }
}