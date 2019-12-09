<?php

namespace app\modules\parseKgdGovKz\models;

use yii\db\ActiveRecord;

class TaxPayerInfo extends ActiveRecord
{

    public function getBccArrearsInfo() {
        return $this->hasMany(BccArrearsInfo::className(), ['id' => 'bcc_arrears_info_id']);
    }

}