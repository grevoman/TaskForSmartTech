<?php

namespace app\modules\parseKgdGovKz\models;

use Yii;

/**
 * This is the model class for table "tax_org_info".
 *
 * @property int $id
 * @property string $nameRu
 * @property string $nameKk
 * @property string $charCode
 * @property int $reportAcrualDate
 * @property float $totalArrear
 * @property float $totalTaxArrear
 * @property float $pensionContributionArrear
 * @property float $socialContributionArrear
 * @property float $socialHealthInsuranceArrear
 * @property float|null $appealledAmount
 * @property float|null $modifiedTermsAmount
 * @property float|null $rehabilitaionProcedureAmount
 * @property int|null $tax_payer_info_id
 *
 * @property CommonInfo[] $commonInfos
 * @property TaxPayerInfo $taxPayerInfo
 */
class TaxOrgInfo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tax_org_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nameRu', 'nameKk', 'charCode', 'reportAcrualDate', 'totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear'], 'required'],
            [['reportAcrualDate', 'tax_payer_info_id'], 'integer'],
            [['totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear', 'appealledAmount', 'modifiedTermsAmount', 'rehabilitaionProcedureAmount'], 'number'],
            [['nameRu', 'nameKk', 'charCode'], 'string', 'max' => 255],
            [['tax_payer_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxPayerInfo::className(), 'targetAttribute' => ['tax_payer_info_id' => 'id']],
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
            'charCode' => 'Char Code',
            'reportAcrualDate' => 'Report Acrual Date',
            'totalArrear' => 'Total Arrear',
            'totalTaxArrear' => 'Total Tax Arrear',
            'pensionContributionArrear' => 'Pension Contribution Arrear',
            'socialContributionArrear' => 'Social Contribution Arrear',
            'socialHealthInsuranceArrear' => 'Social Health Insurance Arrear',
            'appealledAmount' => 'Appealled Amount',
            'modifiedTermsAmount' => 'Modified Terms Amount',
            'rehabilitaionProcedureAmount' => 'Rehabilitaion Procedure Amount',
            'tax_payer_info_id' => 'Tax Payer Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonInfos() {
        return $this->hasMany(CommonInfo::className(), ['tax_org_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxPayerInfo() {
        return $this->hasOne(TaxPayerInfo::className(), ['id' => 'tax_payer_info_id']);
    }

}