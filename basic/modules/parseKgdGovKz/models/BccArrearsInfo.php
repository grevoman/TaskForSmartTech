<?php

namespace app\modules\parseKgdGovKz\models;

use Yii;

/**
 * This is the model class for table "bcc_arrears_info".
 *
 * @property int $id
 * @property int $bcc
 * @property string $bccNameRu
 * @property string $bccNameKz
 * @property float $taxArrear
 * @property float $poenaArrear
 * @property float $percentArrear
 * @property float $fineArrear
 * @property float $totalArrear
 *
 * @property TaxPayerInfo[] $taxPayerInfos
 */
class BccArrearsInfo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'bcc_arrears_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['bcc', 'bccNameRu', 'bccNameKz', 'taxArrear', 'poenaArrear', 'percentArrear', 'fineArrear', 'totalArrear'], 'required'],
            [['bcc'], 'integer'],
            [['taxArrear', 'poenaArrear', 'percentArrear', 'fineArrear', 'totalArrear'], 'number'],
            [['bccNameRu', 'bccNameKz'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'bcc' => 'Bcc',
            'bccNameRu' => 'Bcc Name Ru',
            'bccNameKz' => 'Bcc Name Kz',
            'taxArrear' => 'Tax Arrear',
            'poenaArrear' => 'Poena Arrear',
            'percentArrear' => 'Percent Arrear',
            'fineArrear' => 'Fine Arrear',
            'totalArrear' => 'Total Arrear',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxPayerInfos() {
        return $this->hasMany(TaxPayerInfo::className(), ['bcc_arrears_info_id' => 'id']);
    }

}