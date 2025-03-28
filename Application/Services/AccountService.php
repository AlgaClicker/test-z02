<?php

namespace Application\Services;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Application\Contracts\Services\AccountServiceContract;
use Application\Entities\Account;




use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountService implements AccountServiceContract
{
    private UsersRepositoryContract $usersRepository;
    public function __construct(UsersRepositoryContract $usersRepository)
    {
        $this->usersRepository = $usersRepository;
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
        if (!$account) {
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
            abort(400,'*** Ошибка регистрации пользователя ***');
        }
        if (array_key_exists('fullName',$arrayKeyVal)) {
            $arrayKeyVal['name'] = $arrayKeyVal['fullName'];
        }
        $arrayKeyVal['password'] = Hash::make($arrayKeyVal['password']);
        return $this->usersRepository->create($arrayKeyVal);

    }


    public function getMe() : ?Account
    {
        $user = auth()->user();

        return $this->usersRepository->getById($user->getAuthIdentifier());
    }
}
