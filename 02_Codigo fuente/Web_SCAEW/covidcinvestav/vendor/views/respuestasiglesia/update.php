<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestasiglesia */

$this->title = 'Update Respuestasiglesia: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Respuestasiglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrespuestasiglesias, 'url' => ['view', 'id' => $model->idrespuestasiglesias]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestasiglesia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
