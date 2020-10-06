<?php

namespace Gamer\Http\Controllers\User;

use Gamer\Services\ProfileService;

class HomeController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        parent::__construct();

        $this->profileService = $profileService;
    }

    public function index(Request $request)
    {
        return view('gamer::profile.home.index');
    }
}
