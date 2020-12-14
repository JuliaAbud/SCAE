<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestasiglesia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestasiglesia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrespuestasiglesias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idevaluacion')->textInput() ?>

    <?= $form->field($model, 'idevaluacion_detalle')->textInput() ?>

    <?= $form->field($model, 'idpregunta')->textInput() ?>

    <?= $form->field($model, 'idrubro')->textInput() ?>

    <?= $form->field($model, 'idrespuesta')->textInput() ?>

    <?= $form->field($model, 'idiglesia')->textInput() ?>

    <?= $form->field($model, 'idpresbiterio')->textInput() ?>

    <?= $form->field($model, 'iddistrito')->textInput() ?>

    <?= $form->field($model, 'fecha_limite')->textInput() ?>

    <?= $form->field($model, 'evaluacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pregunta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_dato')->dropDownList([ 'numero' => 'Numero', 'texto' => 'Texto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'rubro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'respuesta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iglesia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presbiterio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'distrito')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
