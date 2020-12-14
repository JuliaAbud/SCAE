<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presbiterio */

$this->title = 'Update Presbiterio: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Presbiterios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpresbiterio, 'url' => ['view', 'id' => $model->idpresbiterio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="presbiterio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
