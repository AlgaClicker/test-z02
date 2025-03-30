<?php

namespace App\Http\Controllers;

use PhpParser\Node\Expr\Cast\Object_;
use App\Http\Response\JsonResponseDefault;
use JMS\Serializer\SerializerBuilder;
use Illuminate\Support\Facades\Response;
abstract class Controller
{
    public SerializerBuilder $serializer;


    //
    public function sendJson($objOrArr)
    {

      if (!$objOrArr) return "null";
        //dd("sendJson",$objOrArr);
        $serializer = SerializerBuilder::create()->build();
        $resultArray =  json_decode($serializer->serialize($objOrArr,'json'));


        return JsonResponseDefault::create(
            'success',
            $resultArray,
            '',
            '',
            "200"
        );
    }

}
