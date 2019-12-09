<?php

use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-6 text-right"><a class="btn btn-info" href="<?= Url::to(['index']) ?>" role="button">Новый запрос</a></div>
    <div class="col-md-6 text-left"><a class="btn btn-info" href="<?= Url::to(['show-saved-data']) ?>" role="button">Сохранённые данные</a></div>
</div>

<?= $content ?>

<?php $this->endContent(); ?>