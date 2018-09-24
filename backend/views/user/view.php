<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use xj\bootbox\BootboxAsset;

BootboxAsset::register($this);
BootboxAsset::registerWithOverride($this);

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Usuário', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
    table.detail-view th {
    	width: 20%;
    }

    table.detail-view td {
    	width: 80%;
    }
");
?>

<div class="user-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Voltar', 'javascript:window.history.go(-1)', ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<span class="fa fa-list"></span>&nbsp;&nbsp;Listar Usuários', ['user/index'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-edit"></span> Editar Dados deste Usuário', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Yii::$app->user->identity->checarAcesso('adminstrador') ? Html::a('<span class="glyphicon glyphicon-remove"></span> Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja remover o Usuário \''.$model->nome.'\'?',
                'method' => 'post',
            ],
        ]) : "" ?>
    </p>

    <div class="row col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><b><?= $model->nome ?></b></h3>
            </div>
            <div class="panel-body">
                <?php if($model->professor): ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nome',
                        'username',
                        'email:email',
                        'perfis',
                        'created_at',
                        'endereco',
                        'telcelular',
                        'telresidencial',
                        'unidade',
                        'turno',
                        'titulacao',
                        'classe',
                        'nivel',
                        'regime',
                        'idLattes',
                        'alias',
                        'idRH',
                    ],
                ])
                ?>

                <?php else: ?>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nome',
                        'username',
                        'email:email',
                        'perfis',
                        [
                            'attribute' => 'created_at',
                             'value' => date('d-m-Y', strtotime($model->created_at)),
                        ],
                        'endereco',
                        'telcelular',
                        'telresidencial',
                        'unidade',
                        'turno',
                        'cargo',
                    ],
                    ]);?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
