<?php
namespace Infrastructure\Repositories;


use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\ObjectEquals;

abstract class AbstractRepository
{

    protected $model;
    protected $entity;
    public function resultEntity() {

        //dd(,$this->entity);

        $en = new $this->entity();

        $lm = [];

        foreach ($this->model->getAttributes() as $attr=>$val ) {
            if (property_exists($en,$attr)) {
                $nameSetMethod = "set".ucfirst($attr);
                $nameGetModelMethod = "get".ucfirst($attr);
                if (method_exists($en,$nameSetMethod)) {
                    $lm[] = $nameSetMethod;
                    $en->$nameSetMethod($val);
                }

            }
        }

        return  $en;
    }





}
