<?php

namespace App\Http\Controllers;

use PhpParser\Node\Expr\Cast\Object_;

abstract class Controller
{
    //
    public function sendJson(?Object $entity=null)
    {
      if (!$entity) return "null";

      $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
      return $serializer->serialize($entity, 'json');
    }
}
