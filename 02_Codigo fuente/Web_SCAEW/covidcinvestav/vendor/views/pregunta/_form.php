<?php

	  use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rubro;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pregunta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->dropDownList([ 'numero' => 'Numero', 'texto' => 'Texto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'idrubro')->DropDownList(
	  ArrayHelper::map(rubro::find()->all(),'idrubro','nombre'),
	  [
	  'prompt'=>'select rubro'
	  ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
