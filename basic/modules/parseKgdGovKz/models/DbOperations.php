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

    public function saveTaxArrearDataFromSite($taxArrearJsonData) {
        $taxArrearData = Json::decode($taxArrearJsonData);
        $bccArrearsInfoId = $this->SaveToBccArrearsInfoTable($taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0]['bccArrearsInfo'][0]);
        $taxPayerInfoId = $this->SaveToTaxPayerInfoTable($taxArrearData['taxOrgInfo'][0]['taxPayerInfo'][0], $bccArrearsInfoId);
        $taxOrgInfoId = $this->SaveToTaxOrgInfoTable($taxArrearData['taxOrgInfo'][0], $taxPayerInfoId);
        $commonInfoId = $this->SaveToCommonInfoTable($taxArrearData, $taxOrgInfoId);
        $this->SaveToIdentificatorTable($taxArrearData['iinBin'], $commonInfoId);
    }

    private function SaveToIdentificatorTable($iinBin, $commonInfoId) {
        $identificatorAR = new identificator();
        $identificatorAR->iinBin = $iinBin;
        $identificatorAR->common_info_id = $commonInfoId;
        $identificatorAR->save();
    }

    private function SaveToCommonInfoTable($taxArrearData, $taxOrgInfoId) {
        $commonInfoAR = new CommonInfo();
        $commonInfoAR->nameRu = $taxArrearData['nameRu'];
        $commonInfoAR->nameKk = $taxArrearData['nameKk'];
        $commonInfoAR->totalArrear = $taxArrearData['totalArrear'];
        $commonInfoAR->pensionContributionArrear = $taxArrearData['pensionContributionArrear'];
        $commonInfoAR->socialContributionArrear = $taxArrearData['socialContributionArrear'];
        $commonInfoAR->socialHealthInsuranceArrear = $taxArrearData['socialHealthInsuranceArrear'];
        $commonInfoAR->appealledAmount = $taxArrearData['appealledAmount'];
        $commonInfoAR->modifiedTermsAmount = $taxArrearData['modifiedTermsAmount'];
        $commonInfoAR->rehabilitaionProcedureAmount = $taxArrearData['rehabilitaionProcedureAmount'];
        $commonInfoAR->sendTime = $taxArrearData['sendTime'];
        $commonInfoAR->tax_org_info_id = $taxOrgInfoId;
        $commonInfoAR->save();
        return $commonInfoAR->id;
    }

    private function SaveToTaxOrgInfoTable($taxOrgInfo, $taxPayerInfoId) {
        $taxOrgInfoAR = new TaxOrgInfo();
        $taxOrgInfoAR->nameRu = $taxOrgInfo['nameRu'];
        $taxOrgInfoAR->nameKk = $taxOrgInfo['nameKk'];
        $taxOrgInfoAR->charCode = $taxOrgInfo['charCode'];
        $taxOrgInfoAR->reportAcrualDate = $taxOrgInfo['reportAcrualDate'];
        $taxOrgInfoAR->totalArrear = $taxOrgInfo['totalArrear'];
        $taxOrgInfoAR->totalTaxArrear = $taxOrgInfo['totalTaxArrear'];
        $taxOrgInfoAR->pensionContributionArrear = $taxOrgInfo['pensionContributionArrear'];
        $taxOrgInfoAR->socialContributionArrear = $taxOrgInfo['socialContributionArrear'];
        $taxOrgInfoAR->socialHealthInsuranceArrear = $taxOrgInfo['socialHealthInsuranceArrear'];
        $taxOrgInfoAR->appealledAmount = $taxOrgInfo['appealledAmount'];
        $taxOrgInfoAR->modifiedTermsAmount = $taxOrgInfo['modifiedTermsAmount'];
        $taxOrgInfoAR->rehabilitaionProcedureAmount = $taxOrgInfo['rehabilitaionProcedureAmount'];
        $taxOrgInfoAR->tax_payer_info_id = $taxPayerInfoId;
        $taxOrgInfoAR->save();
        return $taxOrgInfoAR->id;
    }

    private function SaveToTaxPayerInfoTable($taxPayerInfo, $bccArrearsInfoId) {
        $taxPayerInfoAR = new TaxPayerInfo();
        $taxPayerInfoAR->nameRu = $taxPayerInfo['nameRu'];
        $taxPayerInfoAR->nameKk = $taxPayerInfo['nameKk'];
        $taxPayerInfoAR->iinBin = $taxPayerInfo['iinBin'];
        $taxPayerInfoAR->totalArrear = $taxPayerInfo['totalArrear'];
        $taxPayerInfoAR->bcc_arrears_info_id = $bccArrearsInfoId;
        $taxPayerInfoAR->save();
        return $taxPayerInfoAR->id;
    }

    private function SaveToBccArrearsInfoTable(array $bccArrearsInfo) {
        $bccArrearsInfoAR = new BccArrearsInfo();
        $bccArrearsInfoAR->bcc = $bccArrearsInfo['bcc'];
        $bccArrearsInfoAR->bccNameRu = $bccArrearsInfo['bccNameRu'];
        $bccArrearsInfoAR->bccNameKz = $bccArrearsInfo['bccNameKz'];
        $bccArrearsInfoAR->taxArrear = $bccArrearsInfo['taxArrear'];
        $bccArrearsInfoAR->poenaArrear = $bccArrearsInfo['poenaArrear'];
        $bccArrearsInfoAR->percentArrear = $bccArrearsInfo['percentArrear'];
        $bccArrearsInfoAR->fineArrear = $bccArrearsInfo['fineArrear'];
        $bccArrearsInfoAR->totalArrear = $bccArrearsInfo['totalArrear'];
        $bccArrearsInfoAR->save();
        return $bccArrearsInfoAR->id;
    }

}