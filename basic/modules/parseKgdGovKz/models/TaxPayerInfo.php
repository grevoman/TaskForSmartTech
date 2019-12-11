<?php

namespace app\modules\parseKgdGovKz\models;

use Yii;

/**
 * This is the model class for table "tax_payer_info".
 *
 * @property int $id
 * @property string $nameRu
 * @property string $nameKk
 * @property int $iinBin
 * @property float $totalArrear
 * @property int|null $bcc_arrears_info_id
 *
 * @property TaxOrgInfo[] $taxOrgInfos
 * @property BccArrearsInfo $bccArrearsInfo
 */
class TaxPayerInfo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tax_payer_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nameRu', 'nameKk', 'iinBin', 'totalArrear'], 'required'],
            [['iinBin', 'bcc_arrears_info_id'], 'integer'],
            [['totalArrear'], 'number'],
            [['nameRu', 'nameKk'], 'string', 'max' => 255],
            [['bcc_arrears_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => BccArrearsInfo::className(), 'targetAttribute' => ['bcc_arrears_info_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nameRu' => 'Name Ru',
            'nameKk' => 'Name Kk',
            'iinBin' => 'Iin Bin',
            'totalArrear' => 'Total Arrear',
            'bcc_arrears_info_id' => 'Bcc Arrears Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxOrgInfos() {
        return $this->hasMany(TaxOrgInfo::className(), ['tax_payer_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBccArrearsInfo() {
        return $this->hasOne(BccArrearsInfo::className(), ['id' => 'bcc_arrears_info_id']);
    }

}