<?php

namespace app\modules\parseKgdGovKz\models;

use yii\base\Model;

class BinIinForm extends Model
{
    public $biniin;

    public function rules() {
        return [
            ['biniin', 'required', 'message' => 'Введите ИИН/БИН'],
            ['biniin', 'match', 'pattern' => '/^[0-9]{12}+$/i', 'message' => 'Длина ИИН/БИН должна быть 12 символов'],
        ];
    }

}