<?php

namespace Gamer\Http\Controllers\User;

use Gamer\Services\ProfileService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        parent::__construct();

        $this->profileService = $profileService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('gamer::profile.home.index');
    }
}
