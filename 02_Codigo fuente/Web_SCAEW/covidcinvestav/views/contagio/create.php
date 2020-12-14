<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contagio */

$this->title = Yii::t('app', 'Create Contagio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contagios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contagio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
