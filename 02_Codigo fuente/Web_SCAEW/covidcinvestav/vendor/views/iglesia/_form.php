<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Presbiterio;

/* @var $this yii\web\View */
/* @var $model app\models\Iglesia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iglesia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pastor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->widget(\yii\jui\DatePicker::class, [
    'language' => 'es',
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
]) ?>
    
   <?= $form->field($model, 'estado_civil')->dropDownList([ 'CASADO' => 'CASADO', 'SOLTERO' => 'SOLTERO','VIUDO' => 'VIUDO','DIVORCIADO' => 'DIVORCIADO','SEPARADO' => 'SEPARADO', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'col_pastor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_pastor')->textInput(['maxlength' => false]) ?>

    <?= $form->field($model, 'numero_pastor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correo_pastor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_pastor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cp_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_templo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cp_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_pastoral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'domicilio_correspondencia')->textInput(['maxlength' => false]) ?>

    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => false]) ?>
    
    <?= $form->field($model, 'idpresbiterio')->DropDownList(
      ArrayHelper::map(presbiterio::find()->all(),'idpresbiterio','nombre'),
      [
      'prompt'=>'select presbiterio'
      ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
