<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2; 
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\Negocio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="negocio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
	
	 <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aforo')->textInput() ?>
	
	<?= $form->field($model, 'tiempopermanencia')->textInput() ?>

    <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colonia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechacreacion')->Hiddeninput()->label(false) ?>
	
	 
<?php
		$url = \yii\helpers\Url::to(['municipio/lista']);
		 echo $form->field($model, 'idmunicipio')->widget(Select2::classname(), [
			 'initValueText' => $model->municipio->nombre, // set the initial display text
			 'options' => ['placeholder' => 'Buscar rubro','required'=>'true'],
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
		 ])->label("Municipio");

            ?>

		  <?php
		$url = \yii\helpers\Url::to(['rubro/lista']);
		 echo $form->field($model, 'idrubro')->widget(Select2::classname(), [
			 'initValueText' => $model->rubro->nombre, // set the initial display text
			 'options' => ['placeholder' => 'Buscar rubro','required'=>'true'],
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
		 ])->label("Rubro");

            ?>

    <?= $form->field($model, 'idusers')->Hiddeninput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
