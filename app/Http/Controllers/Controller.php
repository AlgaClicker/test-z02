<?php

namespace App\Http\Controllers;

use PhpParser\Node\Expr\Cast\Object_;
use App\Http\Response\JsonResponseDefault;
use JMS\Serializer\SerializerBuilder;
use Illuminate\Support\Facades\Response;
abstract class Controller
{
    public SerializerBuilder $serializer;

    public function serializer($data)
    {
        $serializer = SerializerBuilder::create()->build();
        return json_decode($serializer->serialize($data,'json'));
    }

    //
    public function sendJson($objOrArr)
    {

      if (!$objOrArr) return "null";
        //dd("sendJson",$objOrArr);



        return response()->json([
            'success' => true,
            'data'    => $this->serializer($objOrArr),
            'code'    => 200,
        ],200);
    }

}
