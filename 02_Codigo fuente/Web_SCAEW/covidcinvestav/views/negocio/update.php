<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Negocio */

$this->title = Yii::t('app', 'Modificar Negocio: {nameAttribute}', [
    'nameAttribute' => $model->nombre,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->idnegocio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="negocio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
