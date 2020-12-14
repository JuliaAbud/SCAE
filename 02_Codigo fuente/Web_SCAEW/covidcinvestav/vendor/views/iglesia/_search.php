<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IglesiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iglesia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idiglesia') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'pastor') ?>

    <?= $form->field($model, 'fecha_nacimiento') ?>

    <?= $form->field($model, 'estado_civil') ?>

    <?php // echo $form->field($model, 'col_pastor') ?>

    <?php // echo $form->field($model, 'calle_pastor') ?>

    <?php // echo $form->field($model, 'numero_pastor') ?>

    <?php // echo $form->field($model, 'correo_pastor') ?>

    <?php // echo $form->field($model, 'tel_pastor') ?>

    <?php // echo $form->field($model, 'col_templo') ?>

    <?php // echo $form->field($model, 'calle_templo') ?>

    <?php // echo $form->field($model, 'numero_templo') ?>

    <?php // echo $form->field($model, 'cp_templo') ?>

    <?php // echo $form->field($model, 'municipio_templo') ?>

    <?php // echo $form->field($model, 'estado_templo') ?>

    <?php // echo $form->field($model, 'col_pastoral') ?>

    <?php // echo $form->field($model, 'calle_pastoral') ?>

    <?php // echo $form->field($model, 'numero_pastoral') ?>

    <?php // echo $form->field($model, 'cp_pastoral') ?>

    <?php // echo $form->field($model, 'municipio_pastoral') ?>

    <?php // echo $form->field($model, 'estado_pastoral') ?>

    <?php // echo $form->field($model, 'domicilio_correspondencia') ?>

    <?php // echo $form->field($model, 'pagina_web') ?>

    <?php // echo $form->field($model, 'idpresbiterio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
