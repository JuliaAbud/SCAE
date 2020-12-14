<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluaciondetalle */

$this->title = 'Update Evaluaciondetalle: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Evaluaciondetalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idevaluacion_detalle, 'url' => ['view', 'id' => $model->idevaluacion_detalle]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluaciondetalle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
