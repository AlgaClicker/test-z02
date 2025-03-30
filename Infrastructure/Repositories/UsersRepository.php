<?php

namespace Infrastructure\Repositories;

use App\Models\User;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Application\Entities\Account;
use Illuminate\Support\Facades\Hash;

class UsersRepository extends AbstractRepository implements UsersRepositoryContract{

    protected User $user;
     public function __construct(User $user)
     {
         $this->entity = Account::class;
         $this->setModel($user) ;
         $this->user = $user;
     }


    public function register(array $arrayKeyVal)
    {
        $arrayKeyVal['password'] = Hash::make($arrayKeyVal['password']);

        if (array_key_exists('full_name',$arrayKeyVal)) {
            $arrayKeyVal['name'] = $arrayKeyVal['full_name'];
        } else {
            $arrayKeyVal['name'] =  $arrayKeyVal['email'];
        }

        return $this->create($arrayKeyVal);

    }
    public function getByEmail(string $email): ?Account {

        $account= $this->getUserByEmail($email);

        if ($account) {
            return  $account;
        }
        return null;
    }

    public function getById(string $id): ?Account
    {

        $account = $this->findById($id);
        return $this->setName($account);
    }
    public function getUserByEmail(string $email): ?Account
    {
        $account = parent::findBy(["email"=>$email]);
        if (!$account) return null;
        return $this->setName($account);
    }

    public function checkPassword(Account $account, string $password): ?User
    {
        $user = $this->user;
        $this->setModel($user);
        $user = $this->user->find($account->getId());
        $password_hash = $user->password;
        //$account = $this->findById($user->id);
        if (! $account || ! $user || ! Hash::check($password, $password_hash)) {
            return null;
        }

        return $user;
    }


    public function setName(Account $account): Account
    {
        $this->setModel($this->user);
        $user = $this->getModel()->find($account->getId());
        $account->setFullName($user->name ?? "");
        return $account;
    }


}
