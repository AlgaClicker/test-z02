<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Application\Contracts\Services\AccountServiceContract;
class AuthController extends Controller
{
    private AccountServiceContract $accountService;
    public function __construct(AccountServiceContract $accountService)
    {
        $this->accountService = $accountService;
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

        if ($request->user()) {
            return $this->accountService->getAccountFromId($request->user()->id);
        }
       $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        return $this->sendJson($this->accountService->login(
            $request->get('email'),
            $request->get('password')
        ));

    }

    public function authWebLoginPage(Request $request)
    {

        Log::info("authWebLoginPage:");
        return Inertia::render('LoginPage', [
            'account' => '' ,
            "auth"=>""
        ]);
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
