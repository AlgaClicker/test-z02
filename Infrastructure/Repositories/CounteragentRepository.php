<?php
namespace Infrastructure\Repositories;

use Application\Contracts\Repositories\CounteragentRepositoryContract;
use App\Models\Counteragent as CounteragentModel;
use Application\Entities\Account;
use Application\Entities\Counteragent;

final class CounteragentRepository extends AbstractRepository implements  CounteragentRepositoryContract{

    protected CounteragentModel $counteragent;

    public function __construct(CounteragentModel $counteragent)
    {
        $this->setModel($counteragent);
        $this->entity = Counteragent::class;
    }

    public function getAccountCounteragent($id, $account_id)
    {
        return parent::findBy([
            "id"=>$id,
            "user_id" => $account_id
        ]);
    }
    public function getAccountCounteragents(Account $account): array | null
    {
        return parent::findAllBy(['user_id'=>$account->getId()]);
    }

    public function deleteAccountCounteragents(Account $account)
    {
        return parent::deleteAllBy(['user_id'=>$account->getId()]);
    }
}
