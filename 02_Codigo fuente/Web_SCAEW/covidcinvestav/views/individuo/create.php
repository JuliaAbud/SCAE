<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Individuo */

$this->title = Yii::t('app', 'Create Individuo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Individuos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individuo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
