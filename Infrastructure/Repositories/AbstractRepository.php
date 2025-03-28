<?php
namespace Infrastructure\Repositories;


use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\ObjectEquals;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository
{

    private $model ;
    protected string $entity;

    public function setModel($model)
    {
        $this->model = $model;
    }
    public function getModel() {
        return $this->model;
    }
    public function checkAttr(array $arrayKeyVal): array
    {
        $result = [];
        $model = $this->model;

        foreach ($arrayKeyVal as $key=>$val) {
            if ($model && method_exists($model,'getTable') && Schema::hasColumn($model->getTable(), $key)) {
                $result[$key] = $val;
            }
        }

        return $result;
    }
    public function create(array $arrayKeyVal) {

        $arrayKeyVal = $this->checkAttr($arrayKeyVal);

        try {
            $model =  $this->model->create($arrayKeyVal);


            return $this->resultEntity( $model);
        } catch ( \Exception $e ) {
            dd("create Exception",$e);
            //abort('500', $e->getMessage());
        }

    }

    public function findAllBy(array $arrKeyAttrib): ?array
    {
        $arrKeyAttrib = $this->checkAttr($arrKeyAttrib);
        $model = $this->model;
        foreach ($arrKeyAttrib as $key=>$val) {
            $model->where($key,"=",$val);
        }
        $listEntity = [];


        foreach ($model->get()->all() as $key => $objModel) {
            //dd($objModel,$this->resultEntity($objModel));
            $listEntity[] = $this->resultEntity($objModel);

        }

        return $listEntity;
    }
    public function findBy(array $arrKeyAttrib)
    {

        $arrKeyAttrib = $this->checkAttr($arrKeyAttrib);

        $model = $this->getModel();

        $lis = [];
        if (!method_exists($model,'getTable')) {
            dd($model,$arrKeyAttrib);
            return null;
        }

        $user = DB::table($this->model->getTable());


        foreach ($arrKeyAttrib as $key=>$attribute) {
            $user->where($key,"=",$attribute);
            $lis[$key] = $attribute;
        }

        if ($user->first()) {
            $this->setModel($user->first());
            return $this->resultEntity($user->first());
        }

        return null;


    }

    public function findById($id)
    {
        $this->model = $this->model->find($id);
        return  $this->model;
    }

    public function resultEntity($model) {

        $entity = new $this->entity();
        if (is_object($model) && get_class($model) == 'stdClass') {
            $arrKeyVal = get_object_vars($model);
            foreach ($arrKeyVal as $attr=>$value) {
                if (property_exists($entity,$attr)) {
                    $nameSetMethod = "set".ucfirst($attr);
                    if (method_exists($entity,$nameSetMethod)) {
                        $entity->$nameSetMethod($value);
                    }
                }
            }
        }

        if (is_object($model) && get_class($model) != 'stdClass') {
            if (method_exists($model,'getAttributes')) {
                $attributes = $model->getAttributes();
            } else {
                $attributes = $model;
            }

            foreach ($attributes as $attr=>$val ) {
                if (property_exists($entity,$attr)) {
                    $nameSetMethod = "set".ucfirst($attr);
                    if (method_exists($entity,$nameSetMethod)) {
                        $entity->$nameSetMethod($val);
                    }
                }
            }
        }

        return  $entity;
    }


}
