<?php

namespace app\modules\parseKgdGovKz\models;

use yii\db\ActiveRecord;

class TaxOrgInfo extends ActiveRecord
{

    public function getTaxPayerInfo() {
        return $this->hasMany(TaxPayerInfo::className(), ['id' => 'tax_payer_info_id']);
    }

}