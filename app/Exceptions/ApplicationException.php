<?php

namespace App\Exceptions;
use Exception;


class ApplicationException extends Exception
{

    public function context(Exception $exception): array
    {
        //return $exception->getMessage();
       dd("ApplicationException", $exception);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
        dd("ApplicationException@report");
    }
}
