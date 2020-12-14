<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';

?>
<style type="text/css">
body
{
    font-family: 'Roboto', sans-serif;
    color: #ADADAE;
  background-color: #E4E4E4;
}
.GrisObscuro
{
color: #636363;
}
.GrisClaro
{
color: #ADADAE;
}
    .cuadro
    {
        border: none;
        border-color: black;
        border-bottom: solid;
        border-bottom-width: thin;
        border-color: #414146;
        width: 300px;
        height: 30px;
    }
    .caja
    {
        height: 400px;
        width: 400px;
         box-shadow: 2px 5px 3px 4px #979393;
         vertical-align: middle;
         background-color:white
    }
    .btn-ttc,
.btn-personal {
  color: white;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #6C6C6D;
}
</style>
<center>
    <div class="GrisObscuro" style="font-size:50px;">Evaluaciones en Linea</div>
<div class="caja">
    <div class="GrisObscuro" style="background-color:#E4E4E4; font-size:30px;width: 400px; height:70px; vertical-align: middle; ">
         <div style="position: relative; top: 20px;">
    <?= Html::encode($this->title) ?>
    </div>
</div>
    <?php $form = ActiveForm::begin([

    ]); ?>
        <div class="form-group" ><br>
        Usuario*<br>
        <input required="true" type="text" class="cuadro" name="username"><br><br>
        Contraseña*<br>
        <input required="true" type="password" class="cuadro" name="password">

<br>
<br>

        <div>
            <button type="submit" class="btn btn-personal">
            INICIAR SESIÓN <span class="glyphicon glyphicon-user"></span>
            </button>
            
        </div>
    </div>

    <?php ActiveForm::end(); ?>
<img src='images/iafcj.png' style="width: 120px;height: 150px;position: relative; right: -50%;">
</div>
</center>
