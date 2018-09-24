<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg" style="padding-top:3px">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo','style' => 'height: 55px;']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" style='height:55px;padding:18px 15px;' data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <?php  if(!Yii::$app->user->isGuest){ ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <img src="img/administrador.png" class="img-circle" width="25px" height="25px" alt="User Image"/>

                        <span class="hidden-xs"> <?= Yii::$app->user->identity->nome ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: 80px">

                            <p>
                                <?= Yii::$app->user->identity->nome ?>
                                <?= "<small>Criado em ".Yii::$app->user->identity->created_at."</small>"?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Perfil',
                                    ['user/perfil'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sair',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php }else{ echo Html::a('Login', ['site/login'], ['data-method' => 'post', 'class' => 'btn btn-info btn-lg']); } ?>
            </ul>
        </div>
    </nav>
</header>
