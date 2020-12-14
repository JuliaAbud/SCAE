<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2; 
use yii\web\JsExpression;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Municipio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="municipio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

	<?php
	$url = \yii\helpers\Url::to(['estado/lista']);
	echo $form->field($model, 'idestado')->widget(Select2::classname(), [
	'initValueText' => $model->estado->nombre, // set the initial display text
	'options' => ['placeholder' => 'Buscar estado','required'=>'true'],
	'pluginOptions' => [
	'allowClear' => true,
	'minimumInputLength' => 3,
	'language' => [
	'errorLoading' => new JsExpression("function () { return 'No se entrontraron coincidencias'; }"),
	],
	'ajax' => [
	'url' => $url,
	'dataType' => 'json',
	'data' => new JsExpression('function(params) { return {q:params.term}; }')
	],
	'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
	'templateResult' => new JsExpression('function(city) { return city.text; }'),
	'templateSelection' => new JsExpression('function (city) { return city.text; }'),
	],
	])->label("Estado");

	?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
