<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Projeto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projeto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar', ['projeto/index'], ['class'=>'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
      /*'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'dateFormat' => 'php:d-M-Y',
        'datetimeFormat' => 'php:d/m/Y',
        'timeFormat' => 'php:H:i:s',
        'timeZone' => 'UTC',
      ],*/
        'attributes' => [
            'num_processo',
            'num_protocolo',
            'edital',
            'titulo_projeto',
            'nome_coordenador',
            'inicio_previsto',//:datetime',
            'termino',//:datetime',
            'cotacao_moeda_estrangeira',
            'numero_fapeam_outorga',
            'publicacao_diario_oficial',//:datetime',
        ],
    ]) ?>

</div>
