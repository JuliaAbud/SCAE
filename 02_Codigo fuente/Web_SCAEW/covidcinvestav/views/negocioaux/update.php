<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Negocioaux */

$this->title = Yii::t('app', 'Update Negocioaux: {nameAttribute}', [
    'nameAttribute' => $model->idnegocioaux,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocioauxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnegocioaux, 'url' => ['view', 'id' => $model->idnegocioaux]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="negocioaux-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
