<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Visita */

$this->title = Yii::t('app', 'Create Visita');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visitas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
