<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $resultArray array */
/* @var $resultJson array */
?>
<div class="parseKgdGovKz-default-index">
    <?php
    $formBiniin = ActiveForm::begin([
                'id' => 'biniin-form',
                'options' => ['class' => 'form-horizontal'],
            ])
    ?>
    <?= $formBiniin->field($modelBinIinForm, 'biniin')->label('Введите ИИН/УИН') ?>


    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php
    if (!empty($resultArray)) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Сведения об отсутствии (наличии) задолженности, учет по которым ведется в органах государственных доходов</h2>
            </div>
        </div>
        <div>
            <div class="panel-heading">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Наименование налогоплательщика</td>
                            <td class="font-bold" id="table1_name"><?= $resultArray['nameRu'] ?></td>
                        </tr>
                        <tr>
                            <td id="result.table.1.row.2">ИИН/БИН налогоплательщика</td>
                            <td class="font-bold" id="table1_iinBin"><?= $resultArray['iinBin'] ?></td>
                        </tr>
                        <tr>
                            <td id="result.table.1.row.3">Всего задолженности (тенге)</td>
                            <td class="font-bold" id="table1_totalArrear"><?= $resultArray['totalArrear'] ?></td>
                        </tr>
                    </tbody></table>
            </div>

            <div class="panel panel-default">
                <table id="table1" class="table borderless m-t">
                    <tbody><tr>
                            <td id="result.table.2.row.1">Итого задолженности в бюджет</td>
                            <td class="font-bold tdWidth" id="table2_totalTaxArrear"><?= $resultArray['totalTaxArrear'] ?></td>
                        </tr>
                        <tr>
                            <td id="result.table.2.row.2">Задолженность по обязательным пенсионным взносам, обязательным профессиональным пенсионным взносам</td>
                            <td class="font-bold tdWidth" id="table2_pensionContributionArrear"><?= $resultArray['pensionContributionArrear'] ?></td>
                        </tr>
                        <tr>
                            <td id="result.table.2.row.med">Задолженность по отчислениям и (или) взносам на обязательное социальное медицинское страхование</td>
                            <td class="font-bold tdWidth" id="table2_socialHealthInsuranceArrear"><?= $resultArray['socialHealthInsuranceArrear'] ?></td>
                        </tr>
                        <tr>
                            <td id="result.table.2.row.3">Задолженность по социальным отчислениям</td>
                            <td class="font-bold tdWidth" id="table2_socialContributionArrear"><?= $resultArray['socialContributionArrear'] ?></td>
                        </tr>
                    </tbody></table>
            </div>

            <div id="taxorginfo_cyclic_table">
                <span id="result.header.2" class="text-info">Таблица задолженностей по органам государственных доходов</span>
                <?php
                foreach ($resultArray['taxOrgInfo'] as $taxOrgInfo) {
                    ?>
                    <div id="TableContener_0" class="m-t">
                        <div id="taxOrgPanel-0" class="panel panel-default">
                            <div class="panel-heading font-bold">
                                <?= $taxOrgInfo['nameRu'] ?> Код ОГД <strong><?= $taxOrgInfo['charCode'] ?></strong>
                            </div>
                            <div class="panel-body">
                                <div id="result.table.3.row.2">
                                    По состоянию на <?= date('Y-m-d', substr($taxOrgInfo['reportAcrualDate'], 0, 10)) ?>
                                </div>
                                <div id="result.table.3.row.3">
                                    Всего задолженности: <?= $taxOrgInfo['totalArrear'] ?>
                                </div>
                            </div>
                            <div class="panel-footer bg-light lter">
                                <button class="btn btn-sm btn-default m-t-sm" data-toggle="collapse" data-target="#tableInfo-0" aria-expanded="true">Подробнее...</button>
                                <div id="Table-0-Content" class="m-t-sm">
                                    <div class="collapse in" id="tableInfo-0" aria-expanded="true" style="">
                                        <table id="table4_0" class="table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td id="result.table.4.row.1">Итого задолженности в бюджет</td>
                                                    <td class="tdWidth font-bold" id="taxOrgInfo_totalTaxArrear"><?= $taxOrgInfo['totalTaxArrear'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td id="result.table.4.row.2">Задолженность по обязательным пенсионным взносам, обязательным профессиональным пенсионным взносам</td>
                                                    <td class="tdWidth font-bold" id="taxOrgInfo_pensionContributionArrear"><?= $taxOrgInfo['pensionContributionArrear'] ?></td>
                                                </tr>
                                                <tr>	
                                                    <td id="result.table.4.row.med">Задолженность по отчислениям и (или) взносам на обязательное социальное медицинское страхование</td>
                                                    <td class="tdWidth font-bold" id="taxOrgInfo_socialHealthInsuranceArrear"><?= $taxOrgInfo['socialHealthInsuranceArrear'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td id="result.table.4.row.3">Задолженность по социальным отчислениям</td>	
                                                    <td class="tdWidth font-bold" id="taxOrgInfo_socialContributionArrear"><?= $taxOrgInfo['socialContributionArrear'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div id="Table3-0-Content">
                                            <span id="result.header.3" class="text-info">Таблица задолженностей по налогоплательщику и его структурным подразделениям</span>
                                            <?php
                                            foreach ($taxOrgInfo['taxPayerInfo'] as $taxPayerInfo) {
                                                ?>
                                                <div class="wrapper m-t">
                                                    <table class="table table-bordered table-hover" id="table5_0">
                                                        <tbody>
                                                            <tr>
                                                                <td id="result.table.5.row.1">Наименование налогоплательщика:</td>
                                                                <td class="font-bold" id="taxPayerInfo_name"><?= $taxPayerInfo['nameRu'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td id="result.table.5.row.2">ИИН/БИН налогоплательщика:</td>
                                                                <td class="font-bold" id="taxPayerInfo_iinBin"><?= $taxPayerInfo['iinBin'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td id="result.table.5.row.3">Всего задолженности:</td>
                                                                <td class="font-bold" id="taxPayerInfo_totalArrear"><?= $taxPayerInfo['totalArrear'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-sm btn-default" data-toggle="collapse" data-target="#tableInfo-0-0" aria-expanded="true">Подробнее...</button>
                                                    <?php
                                                    foreach ($taxPayerInfo['bccArrearsInfo'] as $bccArrearsInfo) {
                                                        ?>
                                                        <div class="collapse in" id="tableInfo-0-0" aria-expanded="true" style="">
                                                            <div id="Table2-0-0-Content">
                                                                <table class="table table-bordered table-hover" style="font-size:12px;" id="table6_0_0">    
                                                                    <thead>
                                                                        <tr>        
                                                                            <th id="result.table.6.column.1.label" style="width:20%">КБК</th>
                                                                            <th id="result.table.6.column.2.label" style="width:15%">Задолженность по платежам, учет по которым ведется в органах государственных доходов</th>
                                                                            <th id="result.table.6.column.3.label" style="width:15%">Задолженность по сумме пени</th>        
                                                                            <th id="result.table.6.column.4.label" style="width:15%">Задолженность по сумме процентов</th>        
                                                                            <th id="result.table.6.column.5.label" style="width:15%">Задолженность по сумме штрафа</th>
                                                                            <th id="result.table.6.column.6.label" style="width:15%">Всего задолженности</th>    
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td id="104402"><?= $bccArrearsInfo['bcc'] ?> <?= $bccArrearsInfo['bccNameRu'] ?></td>
                                                                            <td><?= $bccArrearsInfo['taxArrear'] ?></td>
                                                                            <td><?= $bccArrearsInfo['poenaArrear'] ?></td>
                                                                            <td><?= $bccArrearsInfo['percentArrear'] ?></td>
                                                                            <td><?= $bccArrearsInfo['fineArrear'] ?></td>
                                                                            <td><?= $bccArrearsInfo['totalArrear'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            $formSave = ActiveForm::begin([
                        'id' => 'save-form',
                        'options' => ['class' => 'form-horizontal'],
                    ])
            ?>
            <?= $formSave->field($modelSaveDataForm, 'iinBin')->hiddenInput(['value' => $resultArray['iinBin']])->label(false); ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php
            ActiveForm::end()
            ?>
        </div>
        <?php
    }
    ?>
</div>
