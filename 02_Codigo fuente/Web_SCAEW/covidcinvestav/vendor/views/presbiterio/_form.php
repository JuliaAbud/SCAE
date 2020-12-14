<?php

	  use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Distrito;

/* @var $this yii\web\View */
/* @var $model app\models\Presbiterio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presbiterio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prebitero')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'iddistrito')->DropDownList(
	  ArrayHelper::map(distrito::find()->all(),'iddistrito','nombre'),
	  [
	  'prompt'=>'select distrito'
	  ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
