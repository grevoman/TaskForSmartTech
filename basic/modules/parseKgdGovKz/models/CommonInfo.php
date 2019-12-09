<?php

namespace app\modules\parseKgdGovKz\models;

use yii\db\ActiveRecord;

class CommonInfo extends ActiveRecord
{

    public function getTaxOrgInfo() {
        return $this->hasMany(TaxOrgInfo::className(), ['id' => 'tax_org_info_id']);
    }

}