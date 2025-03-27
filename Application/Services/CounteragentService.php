<?php

namespace Application\Services;

use Application\Contracts\Services\CounteragentServiceContract;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;

class CounteragentService implements  CounteragentServiceContract
{


    public function getInnDaData($inn)
    {
        $dadata = DaDataCompany::id(trim($inn), 1, null, BranchType::MAIN, CompanyType::LEGAL);

        
        dd($inn,$dadata);
    }
}
