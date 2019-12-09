<?php

namespace app\modules\parseKgdGovKz\models;

use yii\base\Model;

class SaveDataForm extends Model
{
    public $iinBin;

    public function rules() {
        return [
            ['iinBin', 'required'],
            ['iinBin', 'match', 'pattern' => '/^[0-9]{12}+$/i'],
        ];
    }

}