<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DistritoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'iddistrito') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'obispo') ?>

    <?= $form->field($model, 'col_oficina') ?>

    <?= $form->field($model, 'calle_oficina') ?>

    <?php // echo $form->field($model, 'numero_oficina') ?>

    <?php // echo $form->field($model, 'cp_oficina') ?>

    <?php // echo $form->field($model, 'municipio_oficina') ?>

    <?php // echo $form->field($model, 'estado_oficina') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
