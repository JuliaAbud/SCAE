<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\fileupload\FileUpload;
use dosamigos\fileupload\FileUploadUI;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NegocioauxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cargar Negocio');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocioaux-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
   <?= FileUploadUI::widget([
'model' => $model,
'attribute' => 'idnegocioaux',
'url' => ['negocioaux/upload'],
'gallery' => false,
'options' => ['accept' => 'file/.xls','extensions' => 'gif, jpg',],

'fieldOptions' => [
'accept' => '.xls, .xlsx',
],
'clientOptions' => [
'maxFileSize' => 1000000,
'multiple'=>'false',
'allowedExtensions' => array('jpeg', 'jpg', 'gif', 'png'),
],
// ...
'clientEvents' => [
'fileuploaddone' => 'function(e, data) {
	if(data._response.result.files[0].url.includes("Formato"))
	{
					alert("Archivo no contiene el formato correcto, revise el archivo de ejemplo y recuerde incluir todos los encabezados:\n"+data._response.result.files[0].name);
					location.reload();
	}
	else
	if(data._response.result.files[0].name!="Error")
	{
					alert("Archivo cargado correctamente");
					location.reload();
	}
	else
	{
		alert("The file doesnt contain the rigth format for the load\nPlease check\n"+data._response.result.files[0].name);
		$("#avisotabla").css("display", "block");
	}
							}',
'fileuploadfail' => 'function(e, data) {
								alert("Upload failed, please try again.");
							}',
],
]); 

?>
<a href="<?= Url::toRoute(["descargarformato"]) ?>">Descargar archivo de formato</a>
<br>
<?php if(count($dataProvider->models)>0) echo Html::a(Yii::t('app', 'Cargar a negocios'), ['negocioaux/transferirdatos'], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => Yii::t('app', 'Confirma en cargar los negocios?'),
                'method' => 'post',
            ],
        ]); ?>

   </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idnegocioaux',
            //'codigo',
            'nombre',
            //'codigoactividad',
			[
				'attribute' => 'rubro.nombre',
			   'label' => 'Actividad',
            ],
            'aforo',
            'tiempopermanencia',
            'calle',
            'numero',
            'colonia',
            'entidad',
            'municipio',
            'cp',
            'latitud',
           'longitud',
            //'idmunicipio',
            //'idrubro',
            [
				'attribute' => 'users.username',
			   'label' => 'Propietario',
            ],
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
