<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Negocioaux */

$this->title = $model->idnegocioaux;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocioauxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocioaux-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idnegocioaux], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idnegocioaux], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idnegocioaux',
            'codigo',
            'nombre',
            'codigoactividad',
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
            'idmunicipio',
            'idrubro',
            'idusers',
            'email:email',
        ],
    ]) ?>

</div>
