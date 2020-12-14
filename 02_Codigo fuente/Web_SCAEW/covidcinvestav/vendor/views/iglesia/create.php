<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Iglesia */

$this->title = 'Create Iglesia';
$this->params['breadcrumbs'][] = ['label' => 'Iglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iglesia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
