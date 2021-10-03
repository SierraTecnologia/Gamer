<?php

namespace Gamer\Processing;

use Log;

class CalculeMetrics
{
    
    public function __construct()
    {
        
    }

    public function run(): void
    {
        $this->byPeriod();
    }

    public function byPeriod(): void
    {
        $this->forIntegrations();
    }
    
    public function forIntegrations(): void
    {
        $selfClass = $this;
        $this->board->executeForEachIntegration(
            function ($integration) use ($selfClass) {
                $selfClass->forComponents($integration);
            }
        );
    }
    
    public function forComponents($integration): void
    {
        $selfClass = $this;
        $this->board->executeForEachComponent(
            function ($component, $callback) use ($integration) {
                $data = $integration->getNewDataForComponent($component);
                foreach($data as $result) {
                    $callback($result);
                }
            }
        );
    }

}
