<?php

namespace Gamer\Connectors;

use Gamer\Entitys\PlayerEntity;
use Gamer\Entitys\TeamEntity;
use Gamer\Entitys\CompetitionEntity;
use Gamer\Entitys\CompetitionPlayerEntity;
use Gamer\Entitys\ScoreSerieEntity;
use Gamer\Entitys\ScoreSeriesPointTypeEntity;
use Illuminate\Support\Collection;

/**
 * pointagram
 */
class Pointagram
{
    protected $uri = 'https://app.pointagram.com/server/externalapi.php/';

    /**
     * isAuthenticated - private method used to determine if we're authenticated
     *
     * @return bool
     */
    private function isAuthenticated()
    {
        if (!$this->uri || !config('gamer.services.pointagram') || !config('gamer.services.pointagram_user', 'ricardo@ricasolucoes.com.br')) {
            echo "Not authenticated\n";
            return false;
        }
        return true;
    }

    /**
     * prepCurl - prepare the curl object
     *
     * @param string $url URL
     *
     * @return mixed
     */
    private function prepCurl($url, $postArray = null)
    {
        $headers = array(
            'api_key: ' . config('gamer.services.pointagram'),
            'api_user: ' . config('gamer.services.pointagram_user', 'ricardo@ricasolucoes.com.br'),
            'Content-Type: application/json',
            // 'Authorization: Basic ' . $this->encodedCredential
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_PORT, '443');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ($postArray) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postArray);
        }

        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        return $ch;
    }

    /**
     * listPlayers
     *
     * @return array (containing id's of pr's)
     */
    public function listPlayers(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_players";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            foreach ($result as $playerResult) {
                $player = new PlayerEntity();
                $player->setName($playerResult['Name']);
                $player->setEmail($playerResult['emailaddress']);
                $player->setExternal('pointagram', $playerResult['id']);
                array_push($prIds, $player);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }

    /**
     * createPlayer
     *
     * @param PlayerEntity $player Player Entity
     *
     * @return array
     */
    public function createPlayer(PlayerEntity $player)
    {
        // {
        //     “player_name”: “Axl Rose”,
        //     “player_email”: “axl@pointagram.com”,
        //     “player_external_id”: “121212”,
        //     “offline”: “1”
        // }
        $postArray = [
            "player_name" => $player->getName(),
            "player_email" => $player->getEmail(),
            "player_external_id" => $player->getId(),
            "offline" => "1"
        ];
        if ($this->isAuthenticated()) {
            $url = $this->uri('create_player');
            $ch = $this->prepCurl($url, $postArray);

            $responseString = curl_exec($ch);

            $curlInfo = curl_getinfo($ch);

            return json_decode($responseString, true);
        }
    }

    /**
     * removePlayer
     *
     * @param PlayerEntity $player Player Entity
     *
     * @return array (containing branch names)
     */
    public function removePlayer(PlayerEntity $player)
    {
        // { 
        // “player_name”: “Axl Rose”, 
        // “player_email”: “axl@pointagram.com”, 
        // “player_external_id”: “121212”  
        // } 
        $postArray = [
            "player_name" => $player->getName(),
            "player_email" => $player->getEmail(),
            "player_external_id" => $player->getId()
        ];
        if ($this->isAuthenticated()) {
            $url = $this->uri . "remove_player";
            $ch = $this->prepCurl($url, $postArray);

            $responseString = curl_exec($ch);

            $curlInfo = curl_getinfo($ch);

            return json_decode($responseString, true);
        }
    }

    /**
     * listTeams
     *
     * @return Collection
     */
    public function listTeams(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_teams";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            foreach ($result as $teamResult) {
                $team = new TeamEntity();
                $team->setName($teamResult['name']);
                $team->setIcon($teamResult['icon']);
                $team->setExternal('pointagram', $teamResult['id']);
                array_push($prIds, $team);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }

    /**
     * add_to_team - retrieve ids of all open prs for this branch
     *
     * @param string $branch branch name
     *
     * @return array
     */
    public function add_to_team($branch)
    {
        // {
        // “player_id”: “121212”,
        // “teamid”: “1”
        // }
        if ($this->isAuthenticated()) {
            $url = $this->uri . "add_to_team";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);

            $curlInfo = curl_getinfo($ch);

            $result = json_decode($responseString, true);

            $prIds = [];
            if (array_key_exists('values', $result)) {
                foreach ($result['values'] as $value) {
                    array_push($prIds, $value['id']);
                }
            }

            return $prIds;
        }
    }
    /**
     * removeFromTeam
     *
     * @param string $key PR id
     *
     * @return array
     */
    public function removeFromTeam($key)
    {
        $url = $this->uri . "remove_from_team";
        $headers = array(
            'Authorization: Basic ' . $this->encodedCredential,
            'Content-Type: application/json;charset=UTF-8'
        );

        $data = [];
        $dataString = json_encode($data, JSON_PRETTY_PRINT);

        $ch = $this->prepCurl($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return $response;
    }

    /**
     * addScore
     *
     * @param string $key PR id
     *
     * @return array
     */
    public function addScore($key)
    {
        $url = $this->uri . "add_score";
        $headers = array(
            'Authorization: Basic ' . $this->encodedCredential,
            'Content-Type: application/json;charset=UTF-8'
        );

        $data = ['reason' => 'failed automated build'];
        $dataString = json_encode($data, JSON_PRETTY_PRINT);

        $ch = $this->prepCurl($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return $response;
    }

    /**
     * list_competitions - execute a given pipeline
     *
     * @param string $branch branchname
     * @param string $commit commit hash
     * @param string $pipeline name of pipeline
     *
     * @return array
     */

    /*
    $ curl -X POST -is -u username:password \
      -H 'Content-Type: application/json' \
     https://api.pointagram.org/2.0/repositories/jeroendr/meat-demo2/pipelines/ \
     -d '
      {
         "target": {
          "commit": {
             "hash":"a3c4e02c9a3755eccdc3764e6ea13facdf30f923",
             "type":"commit"
           },
           "selector": {
              "type": "custom",
              "pattern": "Deploy to production"
           },
           "type": "pipeline_ref_target",
           "ref_name": "master",
           "ref_type": "branch"
         }
      }'
    */

    /**
     * listCompetitions
     *
     * @return Collection
     */
    public function listCompetitions(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_competitions";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            // dd($result);
            foreach ($result as $teamResult) {
                $team = new CompetitionEntity();
                $team->setName($teamResult['name']);
                $team->setIcon($teamResult['icon']);
                $team->setExternal('pointagram', $teamResult['id']);
                array_push($prIds, $team);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }



    // list_competition_players

    /**
     * listCompetitionPlayers
     *
     * @return Collection
     */
    public function listCompetitionPlayers(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_competition_players";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            
            foreach ($result as $teamResult) {
                $team = new CompetitionPlayerEntity();
                $team->setName($teamResult['name']);
                $team->setIcon($teamResult['icon']);
                $team->setExternal('pointagram', $teamResult['id']);
                array_push($prIds, $team);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }

    // list_score_series
    public function listScoreSeries(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_score_series";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            dd($result);
            foreach ($result as $teamResult) {
                $team = new ScoreSerieEntity();
                $team->setName($teamResult['name']);
                $team->setIcon($teamResult['icon']);
                $team->setExternal('pointagram', $teamResult['id']);
                array_push($prIds, $team);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }

    // list_score_series_point_types
    public function listScoreSeriesPointTypes(): Collection
    {
        if ($this->isAuthenticated()) {
            $url = $this->uri . "list_score_series_point_types";
            $ch = $this->prepCurl($url);

            $responseString = curl_exec($ch);
            $result = json_decode($responseString, true);

            $curlInfo = curl_getinfo($ch);
            $prIds = [];
            dd($result);
            foreach ($result as $teamResult) {
                $team = new ScoreSeriesPointTypeEntity();
                $team->setName($teamResult['name']);
                $team->setIcon($teamResult['icon']);
                $team->setExternal('pointagram', $teamResult['id']);
                array_push($prIds, $team);
            }
            return new Collection($prIds);
        }
        return new Collection();
    }
}
