<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Visita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoindividuo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idnegocio')->textInput() ?>

    <?= $form->field($model, 'fechavisita')->textInput() ?>

    <?= $form->field($model, 'temperatura')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
