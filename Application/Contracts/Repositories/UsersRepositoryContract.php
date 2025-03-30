<?php

namespace Application\Contracts\Repositories;

use Application\Entities\Account;
use PhpParser\Node\Expr\Cast\Object_;

interface UsersRepositoryContract
{

    public function getById(string $id): ?Account;
    public function getByEmail(string $email): ?Account ;

}
