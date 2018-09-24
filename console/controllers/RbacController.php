<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
  public function actionInit(){
    $auth = new \yii\rbac\DbManager();

    /*Criando Permissões*/
    $edital = $auth->createPermission('edital');
    $edital->description = 'Gerenciar Edital';
    $auth->add($edital);

    $notificacoesselecao = $auth->createPermission('notificacoesselecao');
    $notificacoesselecao->description = 'Notificações ligada a seleção do ppgi';
    $auth->add($notificacoesselecao);

    $usuarios = $auth->createPermission('usuarios');
    $usuarios->description = 'Gerenciar Usuários que acessam o sistema';
    $auth->add($usuarios);

    /*Criando Usuários*/
    $administrador = $auth->createRole('administrador');
    $auth->add($administrador);

    $coordenador = $auth->createRole('coordenador');
    $auth->add($coordenador);

    $secretaria = $auth->createRole('secretaria');
    $auth->add($secretaria);

    $professor = $auth->createRole('professor');
    $auth->add($professor);

    $aluno = $auth->createRole('aluno');
    $auth->add($aluno);

    /*Atribuindo Permissões a Usuários */
    $auth->addChild($coordenador, $edital);
    $auth->addChild($coordenador, $notificacoesselecao);

    $auth->addChild($administrador, $usuarios);
  }
}