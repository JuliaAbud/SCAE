<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cuestionario */
/* @var $form ActiveForm */
?>
<div class="Cuestionario">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'idevaluacion') ?>
        <?= $form->field($model, 'idevaluacion_detalle') ?>
        <?= $form->field($model, 'idpregunta') ?>
        <?= $form->field($model, 'idrubro') ?>
        <?= $form->field($model, 'fecha_limite') ?>
        <?= $form->field($model, 'tipo_dato') ?>
        <?= $form->field($model, 'evaluacion') ?>
        <?= $form->field($model, 'pregunta') ?>
        <?= $form->field($model, 'rubro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Cuestionario -->
