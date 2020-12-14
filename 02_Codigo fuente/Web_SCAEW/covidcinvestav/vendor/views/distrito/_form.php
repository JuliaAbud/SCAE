<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obispo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cp_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_oficina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_oficina')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
