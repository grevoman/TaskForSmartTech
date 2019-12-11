<?php

namespace app\modules\parseKgdGovKz\models;

use Yii;

/**
 * This is the model class for table "common_info".
 *
 * @property int $id
 * @property string $nameRu
 * @property string $nameKk
 * @property float $totalArrear
 * @property float $totalTaxArrear
 * @property float $pensionContributionArrear
 * @property float $socialContributionArrear
 * @property float $socialHealthInsuranceArrear
 * @property float|null $appealledAmount
 * @property float|null $modifiedTermsAmount
 * @property float|null $rehabilitaionProcedureAmount
 * @property string $sendTime
 * @property int|null $tax_org_info_id
 *
 * @property TaxOrgInfo $taxOrgInfo
 * @property Identificator[] $identificators
 */
class CommonInfo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'common_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nameRu', 'nameKk', 'totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear', 'sendTime'], 'required'],
            [['totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear', 'appealledAmount', 'modifiedTermsAmount', 'rehabilitaionProcedureAmount'], 'number'],
            [['tax_org_info_id'], 'integer'],
            [['nameRu', 'nameKk'], 'string', 'max' => 255],
            [['tax_org_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxOrgInfo::className(), 'targetAttribute' => ['tax_org_info_id' => 'id']],
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
            'totalArrear' => 'Total Arrear',
            'totalTaxArrear' => 'Total Tax Arrear',
            'pensionContributionArrear' => 'Pension Contribution Arrear',
            'socialContributionArrear' => 'Social Contribution Arrear',
            'socialHealthInsuranceArrear' => 'Social Health Insurance Arrear',
            'appealledAmount' => 'Appealled Amount',
            'modifiedTermsAmount' => 'Modified Terms Amount',
            'rehabilitaionProcedureAmount' => 'Rehabilitaion Procedure Amount',
            'sendTime' => 'Send Time',
            'tax_org_info_id' => 'Tax Org Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxOrgInfo() {
        return $this->hasOne(TaxOrgInfo::className(), ['id' => 'tax_org_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentificators() {
        return $this->hasMany(Identificator::className(), ['common_info_id' => 'id']);
    }

}