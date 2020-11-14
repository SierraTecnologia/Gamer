<?php

namespace Gamer\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Gamer\Facades\CryptoServiceFacade;

use Gamer\Entitys\PlayerEntity;
use Gamer\Entitys\TeamEntity;
use Gamer\Entitys\CompetitionEntity;
use Gamer\Entitys\CompetitionPlayerEntity;
use Gamer\Entitys\ScoreSerieEntity;
use Gamer\Entitys\ScoreSeriesPointTypeEntity;

class ConnectorService
{

    public function __construct()
    {
        // $this->imageRepo = App::make('MediaManager\Repositories\ImageRepository');
    }
    public function extract()
    {
        $p = new \Gamer\Connectors\Pointagram();

        
        $p->listPlayers()->map(function(PlayerEntity $entity) {
            $entity->persist();
        });

        $p->listTeams()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });

        $p->listCompetitions()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });
        $p->listCompetitionPlayers()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });
        
        $p->listScoreSeries()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });
        $p->listScoreSeriesPointTypes()->map(function(ScoreSerieEntity $entity) {
            $entity->persist();
        });
    }

}
