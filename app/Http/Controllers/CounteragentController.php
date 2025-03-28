<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Application\Contracts\Services\CounteragentServiceContract;

class CounteragentController extends Controller
{

    protected CounteragentServiceContract $counteragentService;

    public function __construct(CounteragentServiceContract $counteragentService)
    {
        $this->counteragentService = $counteragentService;
    }


    public function create(Request $request)
    {
       $request->validate([
            'inn' => 'required|digits:10',
        ]);
        return $this->sendJson($this->counteragentService->createFromInn($request->get('inn')));
    }

     public function get($id)
     {
         return $this->sendJson($this->counteragentService->getCounteragentById($id));
     }

    public function list(Request $request) {
        return "CounteragentController@llist";
    }
}
