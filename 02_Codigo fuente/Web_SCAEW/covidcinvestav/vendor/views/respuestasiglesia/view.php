<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestasiglesia */

$this->title = $model->idrespuestasiglesias;
$this->params['breadcrumbs'][] = ['label' => 'Respuestasiglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestasiglesia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idrespuestasiglesias], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idrespuestasiglesias], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrespuestasiglesias',
            'idevaluacion',
            'idevaluacion_detalle',
            'idpregunta',
            'idrubro',
            'idrespuesta',
            'idiglesia',
            'idpresbiterio',
            'iddistrito',
            'fecha_limite',
            'evaluacion',
            'pregunta',
            'tipo_dato',
            'rubro',
            'respuesta',
            'iglesia',
            'presbiterio',
            'distrito',
        ],
    ]) ?>

</div>
