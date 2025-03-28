<?php

namespace Application\Services;

use Application\Contracts\Repositories\CounteragentRepositoryContract;
use Application\Contracts\Services\CounteragentServiceContract;
use Application\Contracts\Services\AccountServiceContract;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;

class CounteragentService implements  CounteragentServiceContract
{

    private CounteragentRepositoryContract $counteragentRepository;
    private AccountServiceContract $accountService;
    public function __construct(
        CounteragentRepositoryContract $counteragentRepository,
        AccountServiceContract $accountService
    ){
        $this->counteragentRepository = $counteragentRepository;
        $this->accountService = $accountService;
    }

    public function createFromInn($inn)
    {
        $counteragent = $this->getByInn($inn);
        if ($counteragent) {
            return $counteragent;
        }

        $dadata = DaDataCompany::id(trim($inn), 1, null, BranchType::MAIN, CompanyType::LEGAL);

        if ($dadata['suggestions']===[]) {
            abort(400,"ИНН не найден");

        }
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
        return $this->counteragentRepository->findBy(['inn'=>$inn]);
    }
    public function getCounteragentById($id)
    {
        return $this->counteragentRepository->findById($id);
    }


    public function getMyCounteragents()
    {
        return $this->counteragentRepository->getAccountCounteragents($this->accountService->getMe());
    }

}
