<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = 'Update Distrito: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Distritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddistrito, 'url' => ['view', 'id' => $model->iddistrito]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="distrito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>