<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rubro */

$this->title = Yii::t('app', 'Create Rubro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
