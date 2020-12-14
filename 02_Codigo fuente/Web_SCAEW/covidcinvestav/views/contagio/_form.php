<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contagio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contagio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoindividuo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechacontagio')->textInput() ?>

    <?= $form->field($model, 'fechanotificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
