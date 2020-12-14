<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Biometrico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biometrico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idvisita')->textInput() ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'TEMP' => 'TEMP', 'PRES' => 'PRES', 'OXI' => 'OXI', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
