<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

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
    <?php
      function existeEdital($model){
        $path = \Yii::getAlias('@backend/../uploads/projetos/edital/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if(file_exists($file)) {
            return true;
          }else{
            return false;
          }
        }
      }
      function existeTituloProjeto($model){
        $path = \Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/');

        $files = \yii\helpers\FileHelper::findFiles($path, [
          'only' => [$model->id . '.*'],
        ]);
        if (isset($files[0])) {
          $file = $files[0];

          if(file_exists($file)) {
            return true;
          }else{
            return false;
          }
        }
      }
    ?>

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
              'value' => Html::a(($model->edital!='' ? $model->edital : 'Nome não definido') . ' <i class="fas fa-paperclip" ></i>', ['downloadedital', 'id' => $model->id] ) . Html::a(existeEdital($model) ? '| <i class="fa fa-close" ></i> Excluir anexo' : '', ['deleteedital', 'id' => $model->id] ),
            ],
            [
              'attribute' => 'titulo_projeto',
              'label' => 'Titulo do projeto',
              'format' => 'raw',
              'value' => Html::a(($model->titulo_projeto!='' ? $model->titulo_projeto : 'Nome não definido') . ' <i class="fas fa-paperclip" ></i>', ['downloadtitulo', 'id' => $model->id] ) . Html::a(existeTituloProjeto($model) ? '| <i class="fa fa-close" ></i> Excluir anexo' : '', ['deletetitulo', 'id' => $model->id] ),
            ],
            'nome_coordenador',
            'inicio_previsto',//:datetime',
            'termino',
            'cotacao_moeda_estrangeira',
            'numero_fapeam_outorga',
            'publicacao_diario_oficial',//:datetime',
            'duracao',
        ],
    ]) ?>

    <h4 style="font-family: helvetica neue"><strong> Termos Aditivos </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= GridView::widget([
        'dataProvider' => $dataProviderTermoAditivo,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'numero_do_termo',
            'motivo:ntext',
            'vigencia',
/*          [
                'attribute' => 'id_projeto',
                'value' => function ($data) {
                    return Projeto::findOne($data->id_projeto)->titulo_projeto;
                },
            ],
*/
            ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'view'),
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'delete'),
                                'data-method' => 'post'
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='index.php?r=termo-aditivo/view&id='.$model->id;
                    return $url;
                }

                if ($action === 'update') {
                    $url ='index.php?r=termo-aditivo/update&id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='index.php?r=termo-aditivo/delete&id='.$model->id;
                    return $url;
                }

            }
            ]
        ],
    ]); ?>

    <p>
        <?= Html::a('Novo termo aditivo', ['termo-aditivo/create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h4 style="font-family: helvetica neue"><strong> Relatórios técnicos </strong></h4>

    <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 10px; margin-bottom: 20px;">

    <?= GridView::widget([
        'dataProvider' => $dataProviderRelatorioPrestacao,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'header' => 'Número'],

            'data_prevista',
            'data_enviada',
            'tipo',
            'situacao',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'delete'),
                                    'data-method' => 'post'
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=relatorio-prestacao/view&id='.$model->id;
                        return $url;
                    }

                    if ($action === 'update') {
                        $url ='index.php?r=relatorio-prestacao/update&id='.$model->id;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url ='index.php?r=relatorio-prestacao/delete&id='.$model->id;
                        return $url;
                    }

                }
            ]
        ],
    ]); ?>

    <p>
        <?= Html::a('Novo relatório técnico', ['relatorio-prestacao/create'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
