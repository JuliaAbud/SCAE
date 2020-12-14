<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Negocioaux */

$this->title = Yii::t('app', 'Create Negocioaux');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Negocioauxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negocioaux-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
