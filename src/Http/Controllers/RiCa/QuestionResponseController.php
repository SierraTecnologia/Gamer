<?php

namespace Gamer\Http\Controllers\RiCa;

use Gamer\Models\QuestionResponse;
use Gamer\Services\GamerService;
use Illuminate\Support\Facades\Schema;
use Pedreiro\CrudController;

class QuestionResponseController extends Controller
{
    use CrudController;


    public function __construct(QuestionResponse $model)
    {
        $this->model = $model;
        parent::__construct();
    }


    // public function index(Request $request)
    // {
    //     // $service = $this->service;

    //     $service = new \Support\Services\RepositoryService(new \Support\Services\ModelService(Field::class));
    //     $registros = $service->getTableData();
    //     //     $teams = $this->repositoryService->paginated($request->user()->id);

        

    //     return view(
    //         'support::components.repositories.index',
    //         compact('service', 'registros')
    //     );

    //     // return view(
    //     //     'casa::finances.index',
    //     //     compact('service')
    //     // );
    // }
}
