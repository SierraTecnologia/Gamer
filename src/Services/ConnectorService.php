<?php

namespace Gamer\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Gamer\Connectors\Pointagram;
use Gamer\Entities\PlayerEntity;
use Gamer\Entities\TeamEntity;
use Gamer\Entities\CompetitionEntity;
use Gamer\Entities\CompetitionPlayerEntity;
use Gamer\Entities\ScoreSerieEntity;
use Gamer\Entities\ScoreSeriesPointTypeEntity;

class ConnectorService
{
    public $service;

    public function __construct()
    {
        $this->service = new Pointagram();
    }
    public function extract(): void
    {
        $this->service->listPlayers()->map(function(PlayerEntity $entity) {
            $entity->persist();
        });

        $this->service->listTeams()->map(function(TeamEntity $entity) {
            $entity->persist();
        });

        $this->service->listCompetitions()->map(function(CompetitionEntity $entity) {
            $entity->persist();
        });

        $this->service->listCompetitionPlayers()->map(function(CompetitionPlayerEntity $entity) {
            $entity->persist();
        });
        
        $this->service->listScoreSeries()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });

        $this->service->listScoreSeriesPointTypes()->map(function(ScoreSeriesPointTypeEntity $entity) {
            $entity->persist();
        });
    }

}
