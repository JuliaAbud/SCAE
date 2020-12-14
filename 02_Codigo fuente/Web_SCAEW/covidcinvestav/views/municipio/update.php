<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Municipio */

$this->title = Yii::t('app', 'Update Municipio: {nameAttribute}', [
    'nameAttribute' => $model->idmunicipio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Municipios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmunicipio, 'url' => ['view', 'id' => $model->idmunicipio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="municipio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
