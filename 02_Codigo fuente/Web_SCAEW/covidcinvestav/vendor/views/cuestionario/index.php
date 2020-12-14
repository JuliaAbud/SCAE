<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CuestionarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuestionarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuestionario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cuestionario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             'rubro',
            //'idevaluacion',
            'idcuestionario',
            'pregunta',
            'idrubro',
            'tipo_dato',
            //'idevaluacion_detalle',
            'idpregunta',
            //
            //'fecha_limite',
            //'evaluacion',
            
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
