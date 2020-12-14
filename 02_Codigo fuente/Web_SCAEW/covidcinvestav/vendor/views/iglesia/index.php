<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\IglesiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iglesias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iglesia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iglesia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idiglesia',
            'nombre',
            'pastor',
            //'fecha_nacimiento',
            //'estado_civil',
            //'col_pastor',
            //'calle_pastor',
            //'numero_pastor',
            //'correo_pastor',
            'tel_pastor',
            //'col_templo',
            //'calle_templo',
            //'numero_templo',
            //'cp_templo',
            //'municipio_templo',
            //'estado_templo',
            //'col_pastoral',
            //'calle_pastoral',
            //'numero_pastoral',
            //'cp_pastoral',
            //'municipio_pastoral',
            //'estado_pastoral',
            //'domicilio_correspondencia:ntext',
            //'pagina_web:ntext',
            //'idpresbiterio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
