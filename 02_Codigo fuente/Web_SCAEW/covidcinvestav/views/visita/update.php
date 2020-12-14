<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Visita */

$this->title = Yii::t('app', 'Update Visita: {nameAttribute}', [
    'nameAttribute' => $model->idvisita,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visitas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idvisita, 'url' => ['view', 'id' => $model->idvisita]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="visita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
