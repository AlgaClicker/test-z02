<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Application\Contracts\Services\AccountServiceContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Http\Request;
class AuthWebController extends Controller
{
    private AccountServiceContract $accountService;
    public function __construct(AccountServiceContract $accountService)
    {
        $this->accountService = $accountService;
    }

    public function authLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);




        $account = $this->accountService->login(
            $request->get('email'),
            $request->get('password')
        );

        dd($account);

    }

    public function authWebLoginGet(Request $request) {

        if ($request->inertia()) {

        }
        return Inertia::render('LoginPage', [
            'account' => auth()->user(),
        ]);
    }
    public function authWebLogin(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $account = $this->accountService->login(
            $request->get('email'),
            $request->get('password')
        );

       $token = $account->getToken();


        return Inertia::render('LoginPage', [
            'account' => $this->serializer($account) ,
            "auth"=>$token,
            'can' => [
                'create_user' => Auth::user()->can('create', $account),
            ],
        ]);
    }

    public function authWebLoginOut()
    {
       return Inertia::render('LoginOutPage');
    }
    function authRegister(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
            'password_confirm' => 'required_with:password|same:password|min:4',
            'full_name'=> 'sometimes|required'
        ]);
        $account = $this->accountService->register($request->all());

        return Inertia::render('RegistrationPage', [
            'account' => $this->serializer($account) ,
        ]);
    }
}
