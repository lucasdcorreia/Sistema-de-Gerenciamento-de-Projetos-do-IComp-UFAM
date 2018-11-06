<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Projeto */

$this->title = "Projeto";
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="projeto-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Voltar', ['projeto/index'], ['class'=>'btn btn-default']) ?>
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
            [
              'attribute' => 'edital',
              'label' => 'Edital',
              'format' => 'raw',
              'value' => ($model->edital!='' ? $model->edital : 'Nome não definido') . ' ' . Html::a('<i class="fas fa-paperclip" ></i>', ['download', 'id' => $model->id] )  . ' | ' . Html::a('<i class="fa fa-close" ></i> Excluir anexo', ['deleteanexo', 'id' => $model->id] ),
            ],
            'titulo_projeto',
            'nome_coordenador',
            'inicio_previsto',//:datetime',
            'termino',//:datetime',
            'cotacao_moeda_estrangeira',
            'numero_fapeam_outorga',
            'publicacao_diario_oficial',//:datetime',
            'duracao',
        ],
    ]) ?>

</div>
