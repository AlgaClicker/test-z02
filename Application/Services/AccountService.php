<?php

namespace Application\Services;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Application\Contracts\Services\AccountServiceContract;
use Application\Entities\Account;

use Application\Contracts\Services\CounteragentServiceContract;

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

        return new Account("free@local.local");
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
        if (!$user) {
            abort("400","Авторизация не пройдена");
        }

        $token = $user->createToken($email)->plainTextToken;

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
        $user = auth()->user();
        return $this->usersRepository->getById($user->getAuthIdentifier());
    }

    public function deleteMyAccount()
    {
        $account_id = $this->getMe()->getId();
        $this->counteragentService->deleteMyCounteragents();
        $this->usersRepository->delete($account_id);

        return $this->usersRepository->delete($account_id);
    }
}
