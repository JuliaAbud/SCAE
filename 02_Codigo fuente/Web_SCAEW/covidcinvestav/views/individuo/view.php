<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Individuo */

$this->title = $model->idindividuo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Individuos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individuo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->idindividuo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->idindividuo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
</p>
<?php echo Html::img('../qr/individuo/'.$model->idindividuo.'.png'); ?> 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'fechacreacion',
        ],
    ]) ?>

</div>
