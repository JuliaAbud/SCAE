<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NegocioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Negocios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nuevo Negocio'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Cargar CVS'), ['negocioaux/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions'=>function($model) {	
	//if(strcmp (trim(strtoupper( $model->location->portal)),trim(strtoupper($portalrfid)))==0)
			if( $model->concurrencia>=$model->aforo)
			{
				return ['class'=>'danger'];     
			}
			else if( $model->concurrencia>=$model->aforo/2)
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
            //'codigo',
            'nombre',
            //'descripcion',
			[
				'attribute' => 'rubro.nombre',
			   'label' => 'Rubro',
            ],
            'aforo',
			'concurrencia',
			'tiempopermanencia',
			'email',
			[
				'attribute' => 'users.username',
			   'label' => 'Propietario',
            ],
            //'calle',
            //'numero',
            //'colonia',
            //'cp',
            //'latitud',
            //'longitud',
            //'fechacreacion',
            //'idmunicipio',
            //'idrubro',
            //'idusers',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
