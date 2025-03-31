<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Application\Contracts\Services\CounteragentServiceContract;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CounteragentWebController extends Controller
{
    protected CounteragentServiceContract $counteragentService;

    public function __construct(CounteragentServiceContract $counteragentService)
    {
        $this->counteragentService = $counteragentService;
    }

    public function list(Request $request)
    {

        $list = $this->counteragentService->getMyCounteragents();

        return Inertia::render('CounteragentsPage', [
            'counteragents' => $this->serializer($list) ,
        ]);
    }

    public function addInn(Request $request)
    {

        return $this->list($request);
    }
}
