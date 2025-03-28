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

    public function create(array $arrayKeyVal): ?Account
    {
        $result = parent::create($arrayKeyVal);
        if (!$result) return null;
        return $this->setName($result);
    }

    public function getByEmail(string $email): ?Account {

        $this->model = $this->getUserByEmail($email);

        if ($this->model) {
            $account = $this->resultEntity($this->model);

            if (!$account->getEmail()) return null;
            return $this->setName($account);
        }
        return null;
    }

    public function getById(string $id): ?Account
    {

        $this->model = $this->findById($id);

        $account =  $this->resultEntity($this->model);

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
        $this->setModel($this->user);
        $user = $this->findById($account->getId());
        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }
        return $user;
    }

    public function setName(Account $account): Account
    {

        $this->setModel($this->user);
        $user = $this->findById($account->getId());

        $account->setFullName($user->name ?? "");
        return $account;
    }


}
