<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */

$this->title = 'Update Respuesta: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrespuesta, 'url' => ['view', 'id' => $model->idrespuesta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuesta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
