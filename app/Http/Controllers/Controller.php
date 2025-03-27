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
    public function sendJson(?Object $entity=null)
    {
      if (!$entity) return "null";

        $serializer = SerializerBuilder::create()->build();
        $resultArray =  json_decode($serializer->serialize($entity,'json'));


        return JsonResponseDefault::create(
            'success',
            $resultArray,
            '',
            '',
            "200"
        );
    }

}
