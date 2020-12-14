<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Individuo */

$this->title = Yii::t('app', 'Update Individuo: {nameAttribute}', [
    'nameAttribute' => $model->idindividuo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Individuos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idindividuo, 'url' => ['view', 'id' => $model->idindividuo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="individuo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
