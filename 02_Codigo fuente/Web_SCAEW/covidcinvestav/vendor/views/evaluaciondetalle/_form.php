<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Evaluacion;
use app\models\Pregunta;
/* @var $this yii\web\View */
/* @var $model app\models\Evaluaciondetalle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluaciondetalle-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'idevaluacion')->DropDownList(
	  ArrayHelper::map(evaluacion::find()->all(),'idevaluacion','descripcion'),
	  [
	  'prompt'=>'select evaluacion'
	  ]);?>


     <?= $form->field($model, 'idpregunta')->DropDownList(
	  ArrayHelper::map(pregunta::find()->all(),'idpregunta','texto'),
	  [
	  'prompt'=>'select pregunta'
	  ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
