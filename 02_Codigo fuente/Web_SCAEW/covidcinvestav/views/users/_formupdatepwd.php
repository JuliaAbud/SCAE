<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true,'required'=>true])->label('Confirmar contraseña') ?>
      <?= $form->field($model, 'username')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'email')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'authKey')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'accessToken')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'activate')->hiddenInput()->label(false) ?>
    
     <span style="color: red"><?=$Error?></span>
     <br>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
