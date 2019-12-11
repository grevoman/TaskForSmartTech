<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'ИИН/БИН',
            'attribute' => 'iinBin',
            //'format' => 'text'
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a($data->iinBin, ['detail-view', 'id' => $data->id]);
            },
        ],
        [
            'label' => 'Наименование налогоплательщика',
            'attribute' => 'commonInfo.nameRu',
            'format' => 'text'
        ],
    ],
]);
?>