<?php

namespace Gamer\Observers;

use Event;
use Illuminate\Support\Str;
use Log;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Throwable;

/**
 * @todo Passar pa/ support
 * Call no-op classes on models for all event types.  This just simplifies
 * the handling of model events for models.
 */
class ModelCallbacks extends BaseObserver
{
    
    /**
     * Handle all model events, both Eloquent and Decoy
     *
     * @param string $event
     * @param array  $payload Contains:
     *                         -
     *                         Facilitador\Models\Base
     *                         $model
     *
     * @return null|true
     */
    public function handle($event, $payload)
    {
        list($model) = $payload;
        if ($this->isToIgnore($model, $event)) {
            return;
        }

        Log::warning($event);

        // // Payload
        // ^ Cmgmyr\Messenger\Models\Message^ {#4332
        //     #table: "messages"
        //     #touches: array:1 [
        //       0 => "thread"
        //     ]
        //     #fillable: array:3 [
        //       0 => "thread_id"
        //       1 => "user_id"
        //       2 => "body"
        //     ]
        //     #dates: array:1 [
        //       0 => "deleted_at"
        //     ]
        //     #connection: null
        //     #primaryKey: "id"
        //     #keyType: "int"
        //     +incrementing: true
        //     #with: []
        //     #withCount: []
        //     #perPage: 15
        //     +exists: false
        //     +wasRecentlyCreated: false
        //     #attributes: []
        //     #original: []
        //     #changes: []
        //     #casts: []
        //     #dateFormat: null
        //     #appends: []
        //     #dispatchesEvents: []
        //     #observables: []
        //     #relations: []
        //     +timestamps: true
        //     #hidden: []
        //     #visible: []
        //     #guarded: array:1 [
        //       0 => "*"
        //     ]
        //     #forceDeleting: false
        //   }
          

        // // Get the action from the event name
        // preg_match('#\.(\w+)#', $event, $matches);
        // $action = $matches[1];

        // // If there is matching callback method on the model, call it, passing
        // // any additional event arguments to it
        // $method = 'on'.Str::studly($action);

        // if ($method == 'onCreating') {
        //     $this->runInCreating($model);
        // }
        // else if ($method == 'onCreated') {
        //     $this->runInCreated($model);
        // }
        // else if ($method == 'onValidating' || $method == 'onValidated') {
        //     if (empty(array_slice($payload, 1))) {
        //         // @todo resolver dps
        //         \Log::debug('[Facilitador] ModelCallbacks: ignorando onValidating porque nao tem parametro '.print_r([get_class($model), $method], true));
        //         return true;
        //     }
        // }

        // // @todo resolver isso aqui e o de cima gambi, deu merda
        // if (method_exists($model, $method)) {
        //     // if (!empty(array_slice($payload, 1))) {
        //     //     dd($model, $method, $payload,  array_slice($payload, 1), 'erronoModelCallback');
        //     // }
        //     try {
        //         return call_user_func_array([$model, $method], array_slice($payload, 1));
        //     } catch (FatalThrowableError|Throwable $th) {
        //         \Log::info('[Facilitador] ModelCallbacks: problema aqui'.print_r([get_class($model), $method], true));
        //     }
            
        // }
        return true;
    }
}
