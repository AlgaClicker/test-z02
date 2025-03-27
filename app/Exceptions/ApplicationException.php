<?php

namespace App\Exceptions;
use Exception;


class ApplicationException extends Exception
{

    public function context(): array
    {
       dd("ApplicationException", $this);
    }

}
