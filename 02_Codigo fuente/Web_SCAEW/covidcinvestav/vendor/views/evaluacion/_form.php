<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evaluacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_limite')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuatrimestre')->dropDownList([ 'PRIMERO' => 'PRIMERO', 'SEGUNDO' => 'SEGUNDO', 'TERCERO' => 'TERCERO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'ACTIVA' => 'ACTIVA', 'INACTIVA' => 'INACTIVA', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
