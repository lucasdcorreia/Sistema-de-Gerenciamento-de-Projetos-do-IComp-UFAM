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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'MM/dd/yyyy',
            'datetimeFormat' => 'MM/dd/yyyy',
        ],
        'attributes' => [
            'id',
            'num_processo',
            'inicio_previsto:date',
            'termino:date',
            'nome_coordenador',
            'edital',
            'titulo_projeto',
            'num_protocolo',
            'cotacao_moeda_estrangeira',
            'numero_fapeam_outorga',
            'publicacao_diario_oficial:date',
        ],
    ]) ?>

</div>
