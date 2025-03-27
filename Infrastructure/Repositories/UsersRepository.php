<?php

namespace Infrastructure\Repositories;

use App\Models\User;
use Application\Contracts\Repositories\UsersRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Application\Entities\Account;
class UsersRepository extends AbstractRepository implements UsersRepositoryContract{

     protected User $user;
     protected $entity;
     public function __construct(User $user)
     {

         $this->user = $user;
         $this->model = $user;
         $this->entity = Account::class;

     }

     public function create(string $email,string $password, ?string $fullName=null): Account
     {

         $this->model = User::create([
            'name'=>$fullName ?? "",
            'email'=>$email,
            'password'=>$password
         ]);

         $this->model->save();
         $account =  $this->resultEntity();
         $account->setFullName($this->model->name ?? "");

         return $account;
     }


    public function getByEmail(string $email): ?Account {

        $this->model = $this->getUserByEmail($email);

        if ($this->model) {
            $account = $this->resultEntity($this->model);
            $account->setFullName($this->model->name ?? "");
            return  $account;
        }
        return null;
    }

    public function getById(string $id): ?Account
    {

        $this->model = User::find($id);

        $account =  $this->resultEntity();
        $account->setFullName($this->model->name) ;
        return $account;
    }
    public function getUserByEmail(string $email)
    {
        return User::where('email',$email)->first();
    }


}
