<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Application\Contracts\Services\AccountServiceContract;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutWebController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user() ) {
            to_route("login");
        }

        return Inertia::render('AboutPage', [
            'account' => $request->user() ,
            "auth"=>""
        ]);
    }
}
