<?php

namespace Gamer\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Gamer\Facades\CryptoServiceFacade;
class GamerService
{

    public function __construct()
    {
        // $this->imageRepo = App::make('MediaManager\Repositories\ImageRepository');
    }

}
