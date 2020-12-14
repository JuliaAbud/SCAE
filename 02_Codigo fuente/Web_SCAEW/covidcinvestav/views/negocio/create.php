<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Negocio */

$this->title = Yii::t('app', 'Nuevo Negocio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
