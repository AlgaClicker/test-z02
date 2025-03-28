<?php

namespace Application\Contracts\Services;

use Application\Entities\Account;
use Application\Contracts\Repositories\UsersRepositoryContract;


interface AccountServiceContract
{
    public function Login(string $email, string $password): ? Account;
    public function getAccountFromId($id) : Account;
    public function getMe() : ?Account;
}
