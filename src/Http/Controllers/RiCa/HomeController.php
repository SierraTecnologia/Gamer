<?php

namespace Gamer\Http\Controllers\RiCa;

use Gamer\Services\RootService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $rootService;

    public function __construct(RootService $rootService)
    {
        parent::__construct();

        $this->rootService = $rootService;
    }

    public function index(Request $request)
    {
        return view('gamer::root.home.index');
    }
}
