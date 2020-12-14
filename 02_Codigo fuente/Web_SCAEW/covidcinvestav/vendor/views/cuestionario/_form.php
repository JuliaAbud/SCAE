<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cuestionario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuestionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idevaluacion')->textInput() ?>

    <?= $form->field($model, 'idcuestionario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idevaluacion_detalle')->textInput() ?>

    <?= $form->field($model, 'idpregunta')->textInput() ?>

    <?= $form->field($model, 'idrubro')->textInput() ?>

    <?= $form->field($model, 'fecha_limite')->textInput() ?>

    <?= $form->field($model, 'evaluacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pregunta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_dato')->dropDownList([ 'numero' => 'Numero', 'texto' => 'Texto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'rubro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
