<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Iglesia */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iglesia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar Datos', ['actualizar', 'id' => $model->idiglesia], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('Confirmar Datos', ['respuestasiglesia/respuestas', 'id' => $model->idiglesia,'idrubro' => 0], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idiglesia',
            'nombre',
            'pastor',
            'fecha_nacimiento',
            'estado_civil',
            //'col_pastor',
            'calle_pastor',
            //'numero_pastor',
            'correo_pastor',
            'tel_pastor',
            'col_templo',
            'calle_templo',
            'numero_templo',
            'cp_templo',
            'municipio_templo',
            'estado_templo',
            'col_pastoral',
            'calle_pastoral',
            'numero_pastoral',
            'cp_pastoral',
            'municipio_pastoral',
            'estado_pastoral',
            'domicilio_correspondencia:ntext',
            'pagina_web:ntext',
           // 'idpresbiterio',
        ],
    ]) ?>

</div>
