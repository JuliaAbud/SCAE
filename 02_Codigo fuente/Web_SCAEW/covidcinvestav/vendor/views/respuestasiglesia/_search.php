<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestasiglesiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestasiglesia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idrespuestasiglesias') ?>

    <?= $form->field($model, 'idevaluacion') ?>

    <?= $form->field($model, 'idevaluacion_detalle') ?>

    <?= $form->field($model, 'idpregunta') ?>

    <?= $form->field($model, 'idrubro') ?>

    <?php // echo $form->field($model, 'idrespuesta') ?>

    <?php // echo $form->field($model, 'idiglesia') ?>

    <?php // echo $form->field($model, 'idpresbiterio') ?>

    <?php // echo $form->field($model, 'iddistrito') ?>

    <?php // echo $form->field($model, 'fecha_limite') ?>

    <?php // echo $form->field($model, 'evaluacion') ?>

    <?php // echo $form->field($model, 'pregunta') ?>

    <?php // echo $form->field($model, 'tipo_dato') ?>

    <?php // echo $form->field($model, 'rubro') ?>

    <?php // echo $form->field($model, 'respuesta') ?>

    <?php // echo $form->field($model, 'iglesia') ?>

    <?php // echo $form->field($model, 'presbiterio') ?>

    <?php // echo $form->field($model, 'distrito') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
