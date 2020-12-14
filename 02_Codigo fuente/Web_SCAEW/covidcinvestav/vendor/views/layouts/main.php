<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Evaluaciones</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if(Yii::$app->session['usuario']){
    NavBar::begin([]);
    if(Yii::$app->session['usuario']->nivel==0){
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
             ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Distrito', 'url' => ['/distrito']],
            ['label' => 'Presbiterio', 'url' => ['/presbiterio']],
            ['label' => 'Iglesia', 'url' => ['/iglesia']],
            ['label' => 'Evaluacion', 'url' => ['/evaluacion']],
            ['label' => 'Detalle Evaluacion', 'url' => ['/evaluaciondetalle']],
             ['label' => 'Rubro', 'url' => ['/rubro']],
              ['label' => 'Preguntas', 'url' => ['/pregunta']],
           
            ['label' => 'Acerca de', 'url' => ['/site/about']],
            ['label' => 'Contacto', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
}
    NavBar::end();
}
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
