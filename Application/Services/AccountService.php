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

        $user = $this->usersRepository->getUserByEmail($email);


        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($email)->plainTextToken;

        $account = $this->getAccountFromEmail($email);
        $account->setToken($token);
        return $account;
    }


    public function register(string $email,string $password, ?string $fullName = null): ? Account
    {


        if ($this->getAccountFromEmail($email) !== null) {
            abort(400,'*** Ошибка регистрации пользователя ***');
        }

        $password = Hash::make($password);
        return $this->usersRepository->create($email,$password,$fullName);

    }


    public function getMe()
    {
        $user = auth()->user();

        return $this->usersRepository->getById($user->getAuthIdentifier());
    }
}
