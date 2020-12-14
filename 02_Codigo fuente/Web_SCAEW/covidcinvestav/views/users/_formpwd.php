<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 /*'enableClientValidation' => true,
 'enableAjaxValidation' => true,*/
]);
?>
<div class="form-group">
 <?= $form->field($model, "username")->HiddenInput()->label(false) ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password")->input("password") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password_repeat")->input("password") ?>   
</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
