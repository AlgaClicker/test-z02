<?php
namespace Infrastructure\Repositories;
use Application\Contracts\Repositories\CounteragentRepositoryContract;
use App\Models\Counteragent as CounteragentModel;
use Application\Entities\Counteragent;

final class CounteragentRepository extends AbstractRepository implements  CounteragentRepositoryContract{

    protected CounteragentModel $counteragent;

    public function __construct(CounteragentModel $counteragent)
    {


        $this->setModel($counteragent);

        $this->entity = Counteragent::class;
    }


    public function findBy($arrayKeyVal)
    {

        return parent::findBy($arrayKeyVal);
    }



}
