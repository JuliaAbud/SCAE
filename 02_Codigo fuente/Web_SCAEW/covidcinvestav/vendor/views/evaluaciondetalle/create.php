<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Evaluaciondetalle */

$this->title = 'Create Evaluaciondetalle';
$this->params['breadcrumbs'][] = ['label' => 'Evaluaciondetalles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluaciondetalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
