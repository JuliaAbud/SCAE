<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestasiglesiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestasiglesias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestasiglesia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Datos de la iglesia', ['iglesia/confirm'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idrespuestasiglesias',
            //'idevaluacion',
            //'idevaluacion_detalle',
            //'idpregunta',
            //'idrubro',
            //'idrespuesta',
            //'idiglesia',
            //'idpresbiterio',
            //'iddistrito',
            //'fecha_limite',
            //'evaluacion',
             'rubro',
            'pregunta',
            'tipo_dato',
           
            'respuesta',
            //'iglesia',
            //'presbiterio',
            //'distrito',


        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
