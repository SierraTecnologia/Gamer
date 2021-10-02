<?php

namespace Gamer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Gamer\Services\ConnectorService;

class PointagramIntegrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:pointagram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync your pointagram data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $this->info("Preparando para sincronizar com pointagram");
            app(ConnectorService::class)->extract();

            $this->info("SYnc com sucesso");
    }

}