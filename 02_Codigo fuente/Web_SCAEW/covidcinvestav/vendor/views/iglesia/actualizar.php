<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Presbiterio;

/* @var $this yii\web\View */
/* @var $model app\models\Iglesia */

$this->title = 'Actualizar datos de la Iglesia';
$this->params['breadcrumbs'][] = ['label' => 'Confirmar', 'url' => ['confirm', 'id' => $model->idiglesia]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="iglesia-form">

    <?php $form = ActiveForm::begin(); ?>


</div>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ingresar Iglesia</title>

    
<style>
body
{

}
 input, select, textarea {
    width: 100%;
    padding: 8px 12px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    text-transform: uppercase;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: red;
    padding: 8px 12px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

#create {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 10px;
}   
    

#cabezal{
    border-radius: 5px;
}    
    
    
    
/**----------------------dividir en columnas formulario-----------**/    
    
 #responsive-form{
    max-width:900px /*-- change this to get your desired form width --*/;
    margin:0 auto;
    width:100%;
}
.form-row{
    width: 100%;
}
.column-half, .column-full{
    float: left;
    position: relative;
    padding: 7px;
    width:100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box
}
.clearfix:after {
    content: "";
    display: table;
    clear: both;
}
    
/**---------------- Media query ----------------**/
@media only screen and (min-width: 48em) { 
    .column-half{
        width: 33%;
}

    
</style>    
</head>
    
    
    
<body style="font-family:Verdana;color:#494A50;">


<div id="create">

<div id="cabezal" style="background-color:#e5e5e5;padding:15px;text-align:center;color:#aaaaaa;">
  <h1><?php echo$model->nombre?></h1>
</div>    
    
<div id="responsive-form" class="clearfix" style=text-align:center>
    
    <div class="form-row">
        
 

        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        
        
        <div class="column-full" style="color:#aaaaaa;"><h2> Datos del pastor</h2></div>
        <div class="column-half">

             <?= $form->field($model, 'pastor')->textInput(['maxlength' => true]) ?></div>

        <div class="column-half"><?= $form->field($model, 'fecha_nacimiento')->widget(\yii\jui\DatePicker::class, [
    'language' => 'es',
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
]) ?></div>
 
        <div class="column-half"><?= $form->field($model, 'estado_civil')->dropDownList([ 'CASADO' => 'CASADO', 'SOLTERO' => 'SOLTERO','VIUDO' => 'VIUDO','DIVORCIADO' => 'DIVORCIADO','SEPARADO' => 'SEPARADO', ], ['prompt' => '']) ?></div>
         <?= $form->field($model, 'calle_pastor')->textInput(['maxlength' => false]) ?></div>
  
    
        <div class="column-full" style="color:#aaaaaa;"><h2>Datos de la Iglesia</h2></div>
    
        <div class="column-half">
 <?= $form->field($model, 'idpresbiterio')->DropDownList(
      ArrayHelper::map(presbiterio::find()->all(),'idpresbiterio','nombre'),
      [
      'prompt'=>'select presbiterio'
      ]);?>

            </div>
    
        <div class="column-half">
            <label for="distrito">Distrito al que pertenece</label>
            <input type="text" id="distrito" name="distrito"></div>
    
        <div class="column-half">
             <?= $form->field($model, 'calle_templo')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
           <?= $form->field($model, 'numero_templo')->textInput(['maxlength' => true]) ?></div>

        <div class="column-half">
            <?= $form->field($model, 'col_templo')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
           <?= $form->field($model, 'cp_templo')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
           <?= $form->field($model, 'municipio_templo')->textInput(['maxlength' => true]) ?></div>

        <div class="column-half">
            <?= $form->field($model, 'estado_templo')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
             <?= $form->field($model, 'tel_pastor')->textInput(['maxlength' => true]) ?></div>   
        
        <div class="column-half">
              <?= $form->field($model, 'correo_pastor')->textInput(['maxlength' => true]) ?></div> 
    
        <div class="column-half">
             <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => false]) ?></div>
    

    
     <div class="column-full" style="color:#aaaaaa;"><h2>Domicilio de la casa pastoral</h2></div>
        <div class="column-half">
                <?= $form->field($model, 'calle_pastoral')->textInput(['maxlength' => true]) ?>
</div>
    
        <div class="column-half">
             <?= $form->field($model, 'numero_pastoral')->textInput(['maxlength' => true]) ?></div>

        <div class="column-half">
            
    <?= $form->field($model, 'col_pastoral')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
            <?= $form->field($model, 'cp_pastoral')->textInput(['maxlength' => true]) ?></div>
    
        <div class="column-half">
           
    <?= $form->field($model, 'municipio_pastoral')->textInput(['maxlength' => true]) ?></div>

        <div class="column-half">
           <?= $form->field($model, 'estado_pastoral')->textInput(['maxlength' => true]) ?></div>
    
        
        <div class="column-full">
            <?= $form->field($model, 'domicilio_correspondencia')->textInput(['maxlength' => false]) ?></div>

    
    <div class="column-full"><p>
    	 <?= Html::submitButton('Actualizar datos', ['class' => 'btn btn-primary']) ?>
   <?= Html::a('Confirmar Datos', ['respuestasiglesia/respuestas', 'id' => $model->idiglesia,'idrubro' => 0], ['class' => 'btn btn-primary']) ?><div class="form-group">
       
    </div>
    </p></div>    
</div>


    
    
</div>
    
    
    
    
</body>

</html>
<?php ActiveForm::end(); ?>