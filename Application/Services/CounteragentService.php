<?php

namespace Application\Services;

use Application\Contracts\Repositories\CounteragentRepositoryContract;
use Application\Contracts\Services\CounteragentServiceContract;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use Application\Contracts\Repositories\UsersRepositoryContract;

class CounteragentService implements  CounteragentServiceContract
{

    private CounteragentRepositoryContract $counteragentRepository;
    private UsersRepositoryContract $usersRepository;
    public function __construct(
        CounteragentRepositoryContract $counteragentRepository,
        UsersRepositoryContract $usersRepository
    ){
        $this->counteragentRepository = $counteragentRepository;
        $this->usersRepository = $usersRepository;
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
            "user_id" => auth()->id()
        ];

        return $this->counteragentRepository->create($data);
    }

    public function getByInn($inn) {
        return $this->counteragentRepository->findBy(['inn'=>$inn]);
    }
    public function getCounteragentById($id)
    {
        return $this->counteragentRepository->getAccountCounteragent($id,auth()->id());
    }

    public function deleteCounteragents()
    {
        //$this->accountService->getMe()->getId()
        //$this->counteragentRepository->
    }
    public function getMyCounteragents()
    {
        $account = $this->usersRepository->getById(auth()->id());
        return $this->counteragentRepository->getAccountCounteragents($account);
    }
    public function deleteMyCounteragents()
    {
        $account = $this->usersRepository->getById(auth()->id());
        return $this->counteragentRepository->deleteAccountCounteragents($account);
    }
}
