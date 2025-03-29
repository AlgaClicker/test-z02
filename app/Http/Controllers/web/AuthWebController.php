<?php

namespace App\Http\Controllers\web;

use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Application\Contracts\Services\AccountServiceContract;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AuthWebController extends Controller
{
    protected AccountServiceContract $accountService;
    public function __construct(AccountServiceContract $accountService)
    {
        $this->accountService = $accountService;
    }

    public function login(Request $request)
    {
        return Inertia::render('Login');
    }

    public function about(Request $request)
    {
        Log::info("AuthWebController::about");
        return Inertia::render('AboutPage', [

        ]);
    }
}
