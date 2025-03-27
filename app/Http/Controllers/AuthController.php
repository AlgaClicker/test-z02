<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Application\Contracts\Services\AccountServiceContract;
class AuthController extends Controller
{
    private AccountServiceContract $accountService;
    public function __construct(AccountServiceContract $accountService)
    {
        $this->accountService = $accountService;
    }

    function Auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        dd($this->accountService->getAccountFromId("search id"));

        //return $user->createToken($request->device_name)->plainTextToken;
    }

    function authRegister(Request $request)
    {

    }

    public function authLogin(Request $request)
    {
       $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return $this->sendJson($this->accountService->login(
            $request->get('email'),
            $request->get('password')
        ));

    }

    public function authGetMe()
    {

    }
}
