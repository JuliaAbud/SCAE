<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\Negocio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->idnegocio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->idnegocio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
				 <?php echo Html::a(Yii::t('app', 'Enviar QR por correo'), ['correo', 'id' => $model->idnegocio], ['class' => 'btn btn-primary']) ?>
    
    </p>
<?php echo Html::img('@web/qr/negocio/'.$model->idnegocio.'.png'); ?> 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'nombre',
            'descripcion',
			[
			'attribute' => 'rubro.nombre',
			  'label' => 'Rubro',
            ],
			'email',
            'aforo',
			 'concurrencia',
            'calle',
            'numero',
            'colonia',
            'cp',
            'latitud',
            'longitud',
        ],
    ]) ?>
	<h2>Visitas al establecimiento</h2>
	<?php
		
		$tituloGrafica1 = "Concurrencia por hora";


		
		echo
		Highcharts::widget([
		'scripts' => ['modules'],
		'options' => [
			'chart' => ['type' => 'column'],
			'title' => ['text' => $tituloGrafica1],
			'xAxis' => ['type' => 'category'],
			'yAxis' => ['title' => ['text' => 'Aisitentes']],
			'series' => [
				[
				   'name' => 'Aisitentes',
				   'colorByPoint' => true,
				   'data' => $clickByDeptoCharts
				],
			],
		]
	]);
	?>
	<?php $aforo=$model->aforo;
	echo GridView::widget([
			'dataProvider' => $visitas,
					'rowOptions'=>function($model) use ($aforo) {	
			if( $model->concurrencia>=$aforo)
			{
				return ['class'=>'danger'];     
			}
			else if( $model->concurrencia>=$aforo/2)
			{
				return ['class'=>'warning'];     
			}
			else
			{
				return ['class'=>'success'];     
			}
		},
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				[
				'attribute' => 'fecha',
				   'label' => 'fecha',
				],
				'hora',
				[
					'attribute' => 'concurrencia',
				   'label' => 'Concurrencia',
				],
			],
		]); ?>
</div>
