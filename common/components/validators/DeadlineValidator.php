<?php
namespace common\components\validators;
use yii\validators\Validator;

class DeadlineValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $dateCreate = (int)str_replace('-','',$model->attributes['dateCreate']);
        $dateDeadline = (int)str_replace('-','',$model->$attribute);

        if ($dateDeadline<$dateCreate){
            $this->addError($model,$attribute,'Дата завершения задачи не может быть меньше даты создания задачи!');
        }
    }
}