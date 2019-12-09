<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>
<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'iinBin',
            'label' => 'ИИН/БИН'
        ],
        [
            'attribute' => 'commonInfo.nameRu',
            'label' => 'Ф.И.О'
        ],
    ],
]);
?>