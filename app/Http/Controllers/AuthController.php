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

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
            'password_confirm' => 'required_with:password|same:password|min:4',
            'full_name'=> 'sometimes|required'
        ]);
        return $this->sendJson($this->accountService->register($request->all()));
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
        return $this->sendJson($this->accountService->getMe());
    }

    public function deleteMyAccount()
    {
        return $this->sendJson($this->accountService->deleteMyAccount());
    }

}
