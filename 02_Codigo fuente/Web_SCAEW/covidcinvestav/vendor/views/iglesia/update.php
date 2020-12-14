<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Iglesia */

$this->title = 'Update Iglesia: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Iglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idiglesia, 'url' => ['view', 'id' => $model->idiglesia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="iglesia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
