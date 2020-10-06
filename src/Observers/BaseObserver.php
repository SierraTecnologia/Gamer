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
class BaseObserver
{
    /**
     * Only log the following events
     *
     * @param array
     */
    protected $supported = ['created', 'updated', 'deleted'];

    protected $action = false;
    

    protected function isToIgnore($model, string $event)
    {
        // Don't log changes to pivot models.  Even though a user may have initiated
        // this, it's kind of meaningless to them.  These events can happen when a
        // user messes with drag and drop positioning.
        if (!empty($this->getDontLog())) {
            foreach ($this->getDontLog() as $logClass) {
                if (is_a($model, $logClass)) {
                    return true;
                }
            }
        }
        if (!empty($this->getDontLogAlias())) {
            foreach ($this->getDontLogAlias() as $logClassAlias) {
                if (strpos($event, $logClassAlias) !== false) {
                    return true;
                }
            }
        }

        // Get the action of the event
        preg_match('#eloquent\.(\w+)#', $event, $matches);
        $this->action = $matches[1];
        if (!in_array($this->action, $this->supported)) {
            return true;
        }

        return false;
    }

    protected function getDontLog()
    {
        return [
            'Aschmelyun\Larametrics\Models\LarametricsLog',
            'Illuminate\Database\Eloquent\Relations\Pivot',
        ];
    }

    protected function getDontLogAlias()
    {
        return [
            'Tracking\Models',
            'Analytics',
            'Spatie\Analytics',
            'Wnx\LaravelStats',
            'Aschmelyun\Larametrics\Models',
            'Laravel\Horizon',
            'Support\Models\Application',
            'Support\Models\Ardent',
            'Support\Models\Code',
        ];
    }
}
