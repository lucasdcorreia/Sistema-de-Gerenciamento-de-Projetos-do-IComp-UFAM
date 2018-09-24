<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel='stylesheet' type='text/css' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="http://flwebsites.biz/jAlert/src/jAlert-v3.css">
    <script src='https://code.jquery.com/jquery-2.0.3.min.js'></script>
    <script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ICOMP',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Início', 'url' => ['/site/index']],
    ];

    $session = Yii::$app->session;
    if ($session->get('candidato')) {
        $menuItems[] = [
            'label' => 'Sair',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

    <section class="content">
        <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
        <input id="timesession" type="hidden" value= <?= ini_get('session.gc_maxlifetime');?> />
    </section>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">ICOMP <?= date('Y') ?></p>

        <p class="pull-right">PPGI</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
