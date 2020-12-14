<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cuestionario */

$this->title = 'Update Cuestionario: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cuestionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcuestionario, 'url' => ['view', 'id' => $model->idcuestionario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuestionario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
