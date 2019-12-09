<?php

namespace app\modules\parseKgdGovKz\models;

use yii\db\ActiveRecord;

class Identificator extends ActiveRecord
{

    public function getCommonInfo() {
        return $this->hasMany(CommonInfo::className(), ['id' => 'common_info_id']);
    }

}