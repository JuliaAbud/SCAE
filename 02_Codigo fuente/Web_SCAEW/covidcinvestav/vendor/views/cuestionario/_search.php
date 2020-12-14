<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuestionarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuestionario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idevaluacion') ?>

    <?= $form->field($model, 'idcuestionario') ?>

    <?= $form->field($model, 'idevaluacion_detalle') ?>

    <?= $form->field($model, 'idpregunta') ?>

    <?= $form->field($model, 'idrubro')->DropDownList(
      ArrayHelper::map(rubro::find()->all(),'idrubro','nombre'),
      [
      'prompt'=>'select rubro'
      ]);?>

    <?php // echo $form->field($model, 'fecha_limite') ?>

    <?php // echo $form->field($model, 'evaluacion') ?>

    <?php // echo $form->field($model, 'pregunta') ?>

    <?php // echo $form->field($model, 'tipo_dato') ?>

    <?php // echo $form->field($model, 'rubro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
