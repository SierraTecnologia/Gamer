<?php

namespace Gamer\Observers;

use Event;
use Log;
use Request;

/**
 * Take input from a Many to Many Checklist and commit it to the db,
 * updating the relationships
 */
class LoginObserver extends BaseObserver
{
    public function handle($event): void
    {
        // Log::warning($event); // @todo Veio como objetio bject of class Illuminate\Auth\Events\Login could not be converted to string
        // list($model) = $payload;
        
        // // Check for matching input elements
        // foreach (Request::input() as $key => $val) {
        //     if (preg_match('#^'.self::PREFIX.'(.+)#', $key, $matches)) {
        //         $this->updateRelationship($model, $matches[1]);
        //     }
        // }
    }

    /**
     * @return void
     */
    private function updateRelationship($model, $relationship): void
    {

        // Fire completion event
        // Event::dispatch($prefix."synced: $relationship");
    }
}
