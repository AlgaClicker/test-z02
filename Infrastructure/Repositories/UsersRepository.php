<?php

namespace Infrastructure\Repositories;

use App\Models\User;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Application\Entities\Account;
class UsersRepository extends AbstractRepository implements UsersRepositoryContract{

     private User $user;
     public function __construct(User $user)
     {
         $this->user = $user;
     }

    public function registerNewAccount(string $email,string $password, ?string $fullName=null): ?Account
    {

    }
    public function getAccountById(string $id): ?Account
    {

    }


}
