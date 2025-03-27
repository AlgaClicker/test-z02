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

    public function getAccountFromId($id) : Account
    {

        return new Account("free@local.local");
    }

    public function Login(string $email, string $password): ? Account
    {
        return null;
    }

    public function Register($email,$password, ?string $fullName = null): ? String
    {
        return $this->usersRepository->registerNewAccount($email,$password, $fullName);

    }

}
