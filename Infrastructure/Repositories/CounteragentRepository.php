<?php
namespace Infrastructure\Repositories;
use Application\Contracts\Repositories\CounteragentRepositoryContract;
use App\Models\Counteragent as CounteragentModel;
use Application\Entities\Counteragent;

class CounteragentRepository extends AbstractRepository implements  CounteragentRepositoryContract{

    protected CounteragentModel $counteragent;
    protected $entity;
    public function __construct(CounteragentModel $counteragent)
    {

        $this->model = $counteragent;
        $this->entity = Counteragent::class;
    }




}
