<?php

namespace Application\Services;
use App\Models\User;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Application\Contracts\Services\AccountServiceContract;
use Application\Entities\Account;

use Application\Contracts\Services\CounteragentServiceContract;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function Termwind\terminal;

class AccountService implements AccountServiceContract
{
    private UsersRepositoryContract $usersRepository;
    private CounteragentServiceContract $counteragentService;
    public function __construct(
        UsersRepositoryContract $usersRepository,
        CounteragentServiceContract $counteragentService

    ) {
        $this->usersRepository = $usersRepository;
        $this->counteragentService = $counteragentService;
    }

    public function getAccountFromId($id): Account
    {

        return $this->usersRepository->getById($id);
    }

    public function getAccountFromEmail(string $email): ?Account
    {

        return $this->usersRepository->getByEmail($email);
    }

    public function login(string $email, string $password): ? Account
    {

        $account = $this->usersRepository->getUserByEmail($email);

        if (!$account || $account->getEmail() == null) {
            abort("400","Авторизация не пройдена");
        }



        $user = $this->usersRepository->checkPassword($account, $password);
        auth()->setUser($user);
        $token = $user->createToken("auth")->plainTextToken;

        if (!auth()->user()) {
            abort("401","Авторизация не пройдена");
        }
        $account = $this->usersRepository->getById(auth()->user()->getAuthIdentifier());
        $account->setToken($token);
        return $account;
    }

    public function register(array $arrayKeyVal): ? Account
    {
        if ($this->getAccountFromEmail($arrayKeyVal['email']) !== null) {
            abort("409",'Ошибка регистрации');
        }
        return $this->usersRepository->register($arrayKeyVal);
    }


    public function getMe() : ?Account
    {

        $account = $this->getAccountFromId(auth()->user()->getAuthIdentifier());

        $account->setId(auth()->user()->getAuthIdentifier());

        return $account;
    }

    public function deleteMyAccount()
    {
        $account= $this->getMe();
        $this->counteragentService->deleteCounteragentsByAccount($account);
        $this->usersRepository->delete($account->getId());
    }

    public function checkToken(string $token): ? User
    {
        return null;
    }
}
