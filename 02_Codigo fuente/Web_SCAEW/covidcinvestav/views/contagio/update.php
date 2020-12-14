<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contagio */

$this->title = Yii::t('app', 'Update Contagio: {nameAttribute}', [
    'nameAttribute' => $model->idcontagio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contagios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcontagio, 'url' => ['view', 'id' => $model->idcontagio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contagio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
