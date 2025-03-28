<?php

namespace Application\Services;

use Application\Contracts\Repositories\CounteragentRepositoryContract;
use Application\Contracts\Services\CounteragentServiceContract;
use Infrastructure\Repositories\CounteragentRepository;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;

class CounteragentService implements  CounteragentServiceContract
{

    protected CounteragentRepositoryContract $counteragentRepository;
    public function __construct(CounteragentRepositoryContract $counteragentRepository)
    {
        $this->counteragentRepository = $counteragentRepository;
    }

    public function createFromInn($inn)
    {
        dd($this->getByInn($inn));
        $dadata = DaDataCompany::id(trim($inn), 1, null, BranchType::MAIN, CompanyType::LEGAL);
        $dadata = $dadata['suggestions'][0]['data'];
        $data = [
            "inn"=>$inn,
            "name"=> $dadata['name']['short_with_opf'],
            "ogrn" => $dadata['ogrn'],
            "address" => $dadata['address']['unrestricted_value'],
            "user_id" => auth()->user()->getAuthIdentifier()
        ];

        return $this->counteragentRepository->create($data);
    }

    public function getByInn($inn) {
        return $this->counteragentRepository->fiindBy(['inn'=>$inn]);
    }
    public function getCounteragentById($id)
    {
        return $this->counteragentRepository->fiindById($id);
    }

}
