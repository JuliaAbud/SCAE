<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestasiglesiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluacion Local';

$this->params['breadcrumbs'][] = ['label' => 'Datos de la iglesia', 'url' =>  ['iglesia/actualizar', 'id' =>$id]];
$i=1;
$siguiente=0;
 foreach($modelRubros as $row):
    if($siguiente==1)
    {
        /* $this->params['breadcrumbs'][] = ['label' => 'Siguiente', 'url' =>  ['respuestasiglesia/respuestas/', 'id' =>$id,'idrubro'=>$row->idrubro]];   */
         $siguiente=$row->idrubro;   
         break;
    }
else{
    if($row->idrubro<>$idrubro){
       
     $this->params['breadcrumbs'][] = ['label' => $i, 'url' =>  ['respuestasiglesia/respuestas/', 'id' =>$id,'idrubro'=>$row->idrubro]];
 }
 else
 {
    $this->params['breadcrumbs'][] = ['label' => $i];
     $this->title = $row->nombre;
    $siguiente=1;
 }
}
  $i++;
 endforeach;

?>
<h1><?= Html::encode($this->title) ?></h1>


<div class="respuestasiglesia-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div style="clear:both">

</div>
<div style="clear:both"></div>
   <table class="table table-striped table-bordered"><thead>
<tr><th>#</th><th>Pregunta</th><th>Tipo de dato</th><th>Respuesta</th></tr>
</thead>
<tbody>
     <?php $i=1; foreach($model as $row): ?>
    <tr>
        <td><?= $i++ ?></td>
         <td><?= $row->pregunta ?></td>
        <td><?= $row->tipo_dato ?></td>

        <td>
             <?php  if($row->tipo_dato=="numero"){?>
             <input type="number" required="true" name="Respuesta<?= $row->idrespuestasiglesias ?>" value='<?= $row->respuesta ?>' class="form-control">
             <?php }else {?>
             <input type="text" required="true" name="Respuesta<?= $row->idrespuestasiglesias ?>" value='<?= $row->respuesta ?>' class="form-control">
             <?php }?>
         </td>
    </tr>
    <?php endforeach ?>
</tbody>
</table>
    <?php Pjax::end(); ?>
</div>
  <?= Html::a('Enviar', ['respuestasiglesia/respuestas/', 'id' =>$id,'idrubro'=>$siguiente], ['class' => 'btn btn-success']) ?>