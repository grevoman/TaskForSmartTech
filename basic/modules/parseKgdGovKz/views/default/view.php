<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\parseKgdGovKz\models\Identificator */

\yii\web\YiiAsset::register($this);
?>

<div class="identificator-view">

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
                        <td class="font-bold" id="table1_name"><?= $model->commonInfo->nameRu ?></td>
                    </tr>
                    <tr>
                        <td id="result.table.1.row.2">ИИН/БИН налогоплательщика</td>
                        <td class="font-bold" id="table1_iinBin"><?= $model->iinBin ?></td>
                    </tr>
                    <tr>
                        <td id="result.table.1.row.3">Всего задолженности (тенге)</td>
                        <td class="font-bold" id="table1_totalArrear"><?= $model->commonInfo->totalArrear ?></td>
                    </tr>
                </tbody></table>
        </div>

        <div class="panel panel-default">
            <table id="table1" class="table borderless m-t">
                <tbody><tr>
                        <td id="result.table.2.row.1">Итого задолженности в бюджет</td>
                        <td class="font-bold tdWidth" id="table2_totalTaxArrear"><?= $model->commonInfo->totalTaxArrear ?></td>
                    </tr>
                    <tr>
                        <td id="result.table.2.row.2">Задолженность по обязательным пенсионным взносам, обязательным профессиональным пенсионным взносам</td>
                        <td class="font-bold tdWidth" id="table2_pensionContributionArrear"><?= $model->commonInfo->pensionContributionArrear ?></td>
                    </tr>
                    <tr>
                        <td id="result.table.2.row.med">Задолженность по отчислениям и (или) взносам на обязательное социальное медицинское страхование</td>
                        <td class="font-bold tdWidth" id="table2_socialHealthInsuranceArrear"><?= $model->commonInfo->socialHealthInsuranceArrear ?></td>
                    </tr>
                    <tr>
                        <td id="result.table.2.row.3">Задолженность по социальным отчислениям</td>
                        <td class="font-bold tdWidth" id="table2_socialContributionArrear"><?= $model->commonInfo->socialContributionArrear ?></td>
                    </tr>
                </tbody></table>
        </div>

        <div id="taxorginfo_cyclic_table">
            <span id="result.header.2" class="text-info">Таблица задолженностей по органам государственных доходов</span>
            <div id="TableContener_0" class="m-t">
                <div id="taxOrgPanel-0" class="panel panel-default">
                    <div class="panel-heading font-bold">
                        <?= $model->commonInfo->taxOrgInfo->nameRu ?> Код ОГД <strong><?= $model->commonInfo->taxOrgInfo->charCode ?></strong>
                    </div>
                    <div class="panel-body">
                        <div id="result.table.3.row.2">
                            По состоянию на <?= date('Y-m-d', (int) substr($model->commonInfo->taxOrgInfo->reportAcrualDate, 0, 10)) ?>
                        </div>
                        <div id="result.table.3.row.3">
                            Всего задолженности: <?= $model->commonInfo->taxOrgInfo->totalArrear ?>
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
                                            <td class="tdWidth font-bold" id="taxOrgInfo_totalTaxArrear"><?= $model->commonInfo->taxOrgInfo->totalTaxArrear ?></td>
                                        </tr>
                                        <tr>
                                            <td id="result.table.4.row.2">Задолженность по обязательным пенсионным взносам, обязательным профессиональным пенсионным взносам</td>
                                            <td class="tdWidth font-bold" id="taxOrgInfo_pensionContributionArrear"><?= $model->commonInfo->taxOrgInfo->pensionContributionArrear ?></td>
                                        </tr>
                                        <tr>	
                                            <td id="result.table.4.row.med">Задолженность по отчислениям и (или) взносам на обязательное социальное медицинское страхование</td>
                                            <td class="tdWidth font-bold" id="taxOrgInfo_socialHealthInsuranceArrear"><?= $model->commonInfo->taxOrgInfo->socialHealthInsuranceArrear ?></td>
                                        </tr>
                                        <tr>
                                            <td id="result.table.4.row.3">Задолженность по социальным отчислениям</td>	
                                            <td class="tdWidth font-bold" id="taxOrgInfo_socialContributionArrear"><?= $model->commonInfo->taxOrgInfo->socialContributionArrear ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if (!empty($model->commonInfo->taxOrgInfo->taxPayerInfo)) { ?>
                                    <div id="Table3-0-Content">
                                        <span id="result.header.3" class="text-info">Таблица задолженностей по налогоплательщику и его структурным подразделениям</span>
                                        <div class="wrapper m-t">
                                            <table class="table table-bordered table-hover" id="table5_0">
                                                <tbody>
                                                    <tr>
                                                        <td id="result.table.5.row.1">Наименование налогоплательщика:</td>
                                                        <td class="font-bold" id="taxPayerInfo_name"><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->nameRu ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="result.table.5.row.2">ИИН/БИН налогоплательщика:</td>
                                                        <td class="font-bold" id="taxPayerInfo_iinBin"><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->iinBin ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="result.table.5.row.3">Всего задолженности:</td>
                                                        <td class="font-bold" id="taxPayerInfo_totalArrear"><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->totalArrear ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-sm btn-default" data-toggle="collapse" data-target="#tableInfo-0-0" aria-expanded="true">Подробнее...</button>
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
                                                                <td id="104402"><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->bcc ?> <?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->bccNameRu ?></td>
                                                                <td><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->taxArrear ?></td>
                                                                <td><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->poenaArrear ?></td>
                                                                <td><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->percentArrear ?></td>
                                                                <td><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->fineArrear ?></td>
                                                                <td><?= $model->commonInfo->taxOrgInfo->taxPayerInfo->bccArrearsInfo->totalArrear ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php ?>
                                        </div>
                                        <?php
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
            <?php
            ?>
        </div>
    </div>
</div>
