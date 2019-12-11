<?php

namespace app\modules\parseKgdGovKz\models;

use app\modules\parseKgdGovKz\interfaces\DbOperationsInterface;
use app\modules\parseKgdGovKz\models\BccArrearsInfo;
use app\modules\parseKgdGovKz\models\CommonInfo;
use app\modules\parseKgdGovKz\models\Identificator;
use app\modules\parseKgdGovKz\models\TaxOrgInfo;
use app\modules\parseKgdGovKz\models\TaxPayerInfo;
use yii\helpers\Json;

/**
 * Методы для работы с БД
 * Так как это только тестовое задание, то для упрощения кода и экономии моего
 * времени буду считать, что в массивах taxOrgInfo, taxPayerInfo и bccArrearsInfo 
 * всегда содержиться по одному элементу.
 *
 */
class DbOperations implements DbOperationsInterface
{

    public function getSavedData() {
        return $identificators = Identificator::find()
                ->with('commonInfo.taxOrgInfo.taxPayerInfo.bccArrearsInfo')
                ->all();
    }

    public function saveTaxArrearDataFromSite($taxArrearJsonData) {
        $taxArrearData = Json::decode($taxArrearJsonData);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if (!empty($taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0]['bccArrearsInfo'][0])) {
                $bccArrearsInfoAR = new BccArrearsInfo();
                $bccArrearsInfoAR->attributes = $taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0]['bccArrearsInfo'][0];
                if (!$bccArrearsInfoAR->save()) {
                    throw new \Exception('Can\'t be saved bccArrearsInfoAR model. Errors: ' . join(', ', $bccArrearsInfoAR->getFirstErrors()));
                }
            }

            if (!empty($taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0])) {
                $taxPayerInfoAR = new TaxPayerInfo();
                $taxPayerInfoAR->attributes = $taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0];
                if (!$taxPayerInfoAR->save()) {
                    throw new \Exception('Can\'t be saved taxPayerInfoAR model. Errors: ' . join(', ', $taxPayerInfoAR->getFirstErrors()));
                }
            }

            $taxOrgInfoAR = new TaxOrgInfo();
            $taxOrgInfoAR->attributes = $taxArrearData['taxOrgInfo'][0];
            if (!$taxOrgInfoAR->save()) {
                throw new \Exception('Can\'t be saved taxOrgInfoAR model. Errors: ' . join(', ', $taxOrgInfoAR->getFirstErrors()));
            }

            $commonInfoAR = new CommonInfo();
            $commonInfoAR->attributes = $taxArrearData;
            if (!$commonInfoAR->save()) {
                throw new \Exception('Can\'t be saved commonInfoAR model. Errors: ' . join(', ', $commonInfoAR->getFirstErrors()));
            }

            $identificatorAR = new identificator();
            $identificatorAR->attributes = $taxArrearData;
            if (!$identificatorAR->save()) {
                throw new \Exception('Can\'t be saved identificatorAR model. Errors: ' . join(', ', $identificatorAR->getFirstErrors()));
            }

            $taxPayerInfoAR->bcc_arrears_info_id = $bccArrearsInfoAR->id;
            $taxPayerInfoAR->save();
            $taxOrgInfoAR->tax_payer_info_id = $taxPayerInfoAR->id;
            $taxOrgInfoAR->save();
            $commonInfoAR->tax_org_info_id = $taxOrgInfoAR->id;
            $commonInfoAR->save();
            $identificatorAR->common_info_id = $commonInfoAR->id;
            $identificatorAR->save();

            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
        }
    }

}