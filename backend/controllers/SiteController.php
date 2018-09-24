<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\db\IntegrityException;
use yii\base\Exception;
use yii\base\InvalidParamException;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['request-password-reset', 'reset-password', 'captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->checarAcesso('administrador') || Yii::$app->user->identity->checarAcesso('secretaria');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            try{
                if($model->login()){
                    $this->mensagens('success', 'Autentição', 'Seu login foi efetuado com sucesso.');
                    return $this->goHome();
                }else
                    $this->mensagens('danger', 'Erro ao logar', 'Verifique seu CPF e Senha.');    
            }catch(InvalidParamException $e){
                $this->mensagens('danger', 'Erro ao logar', 'Ocorreu um erro carregar os dados de login. Contate o administrador do sistema.');
            }

            return $this->render('login', [
                'model' => $model,
            ]);

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {
                $this->mensagens('success', 'Usuário Cadastrado', 'Usuário foi salvo com sucesso');
                return $this->redirect(['user/index']);
            }else{
                $this->mensagens('danger', 'Erro ao Cadastrar', 'Ocorreu um erro ao Cadastar Usuário. Verifique os campos e tente novamente');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                $this->mensagens('success', 'Email Enviado com Sucesso.', 'Verifique sua conta de email');

                return $this->goHome();
            } else {
                $this->mensagens('warning', 'Erro ao Enviar Email', 'Desculpe, o email não pode ser enviado. Verique sua conexão ou contate o administrador');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            $this->mensagens('success','Senha Alterada',  'Nova senha salva com Sucesso.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /* Envio de mensagens para views
       Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }
}
