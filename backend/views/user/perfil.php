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
?>
<div class="user-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Voltar', ['index'], ['class' => 'btn btn-warning']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-edit"></span> Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
	<?php if($model->professor){ ?>
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
	<?php 
		}
		else{
	?>
	
	<?=	DetailView::widget([
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
			'cargo',
        ],
		]);?>
		<?php } ?>

</div>
