<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

<?= Html::a('PDF', [
    'site/manual',
    'id' => $model->id,
], [
    'class' => 'btn btn-primary',
    'target' => '_blank',
]); ?>

</div>
