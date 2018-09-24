<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use dbfernandes\icomp\ICompToggleWidget;

$perfis = ['1' => 'Administrador', '2' => 'Coordenador', '3' => 'Secretaria', '4' => 'Professor', '5' => 'Aluno'];

$this->title = 'Adicionar Usuário (Professor ou Técnico Administrativo)';
?>

<div class="site-signup">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Voltar','#',['class' => 'btn btn-warning','onclick'=>"history.go(-1);"]); ?>
        <?= Html::a('<span class="fa fa-list"></span>&nbsp;&nbsp;Listar Usuários', ['user/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <div style= "text-align:left">
        <font color='#FF0000'>*</font> Campos Obrigatórios
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Dados da Conta</b></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'nome')->label("<font color='#FF0000'>*</font> <b>Nome Completo:</b>") ?>
                    <?= $form->field($model, 'username', ['options' => ['class' => 'col-md-6 col-left']])->widget(MaskedInput::className(), [
                        'mask' => '999.999.999-99'])->label("<font color='#FF0000'>*</font> <b>CPF:</b>") ?>
                    <?= $form->field($model, 'email', ['options' => ['class' => 'col-md-6 col-right']])->label("<font color='#FF0000'>*</font> <b>E-mail:</b>") ?>
                    <?= $form->field($model, 'password', ['options' => ['class' => 'col-md-6 col-left']])->passwordInput()->label("Senha:")  ?>
                    <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'col-md-6 col-right']])->passwordInput()->label("Repetir Senha:")  ?>
                    <div style="margin-bottom: 20px;"><b><font color='#FF0000'>*</font> Escolha o(s) perfil(s) correspondente(s) a este usuário: </b></div>
                    <div class = "row">
                        <?= $form->field($model, 'administrador', ['options' => ['class' => 'col-md-3']])->widget(ICompToggleWidget::className(), [
                            'labelEnabled' => 'Sim',
                            'labelDisabled' => 'Não',
                        ]);
                        ?>  
                        <?= $form->field($model, 'coordenador', ['options' => ['class' => 'col-md-3']])->widget(ICompToggleWidget::className(), [
                            'labelEnabled' => 'Sim',
                            'labelDisabled' => 'Não',
                        ]);
                        ?>  
                        <?= $form->field($model, 'secretaria', ['options' => ['class' => 'col-md-3']])->widget(ICompToggleWidget::className(), [
                            'labelEnabled' => 'Sim',
                            'labelDisabled' => 'Não',
                        ]);
                        ?>  
                        <?= $form->field($model, 'professor', ['options' => ['class' => 'col-md-3']])->widget(ICompToggleWidget::className(), [
                            'labelEnabled' => 'Sim',
                            'labelDisabled' => 'Não',
                        ]);
                        ?>  
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Dados Pessoais<b></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true])->label("<b>Endereço:</b>") ?>
                    <?= $form->field($model, 'telresidencial', ['options' => ['class' => 'col-md-6 col-left']])->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => ['(99) 9999-9999','(99) 99999-9999']])->label("<b>Telefone Residencial:</b>")
                    ?>
                    <?= $form->field($model, 'telcelular', ['options' => ['class' => 'col-md-6 col-right']])->widget(MaskedInput::className(), [
                        'mask' => '(99) 99999-9999'])->label("<b>Telefone Celular:</b>")
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>Dados Profissionais<b></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'siape', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true])->label("<b>SIAPE:</b>") ?>
                    <?= $form->field($model, 'dataIngresso', ['options' => ['class' => 'col-md-6 col-right']])->widget(MaskedInput::className(), [
                    'clientOptions' => ['alias' =>  'date']])->label("<b>Data de Ingresso:</b>")?>
                    <?= $form->field($model, 'unidade', ['options' => ['class' => 'col-md-6 col-left']])->textInput(['maxlength' => true])->label("<b>Unidade:</b>") ?>
                    <?= $form->field($model, 'turno', ['options' => ['class' => 'col-md-6 col-right']])->dropDownList(['Matutino e Vespertino' => 'Matutino e Vespertino', 'Matutino e Noturno' => 'Matutino e Noturno', 'Vespertino e Noturno' => 'Vespertino e Noturno'], ['prompt' => 'Selecione o turno...']) ?>
                    <div class="row" id="divSecretaria" style="margin-left: 15px; margin-right: 15px; <?php if(!$model->secretaria) echo 'display:none';?>">
                        <?= $form->field($model, 'cargo')->textInput(['maxlength' => true])->label("<b>Cargo:</b>") ?>
                    </div>
                    <div class="row" id="divProfessor" style="margin-left: 0px; margin-right: 0px; <?php if(!$model->professor) echo 'display:none';?>">
                        <?= $form->field($model, 'titulacao', ['options' => ['class' => 'col-md-6']])->dropDownList(['Graduado' => 'Graduado', 'Especialista' => 'Especialista', 'Mestre' => 'Mestre', 'Doutor' => 'Doutor'], ['prompt' => 'Selecione a titulação...']) ?>
                        <?= $form->field($model, 'regime', ['options' => ['class' => 'col-md-6']])->dropDownList(['20h' => '20h', '40h' => '40h', 'DE' => 'DE'], ['prompt' => 'Selecione o regime de dedicação...']) ?>
                        <?= $form->field($model, 'classe', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<b>Classe:</b>") ?>
                        <?= $form->field($model, 'nivel', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<b>Nível:</b>") ?>
                        <?= $form->field($model, 'idLattes', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("<b>ID Lattes:</b>") ?>
                        <?= $form->field($model, 'idRH', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("<b>Contrato RH:</b>") ?>
                        <?= $form->field($model, 'alias', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("<b>Tag da página do professor:</b>") ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
