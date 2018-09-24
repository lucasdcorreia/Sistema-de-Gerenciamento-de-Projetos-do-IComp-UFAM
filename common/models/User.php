<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yiibr\brvalidator\CpfValidator;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $password;
    public $password_repeat;    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'username', 'auth_key', 'password_hash', 'email', 'visualizacao_candidatos', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas'], 'required'],
            [['password_repeat'], 'required', 'when' => function($model){ return $model->password != "";}, 'whenClient' => "function (attribute, value) {
                return $('#user-password').val() != '';}"],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Esta senha não é igual à anterior", 'when' => function($model){ return $model->password != "";}, 'whenClient' => "function (attribute, value) {
                return $('#user-password').val() != '';}"],
            [['status', 'idLattes', 'idRH'], 'integer'],
            ['password', 'string', 'min' => 6],
            [['username'], CpfValidator::className(), 'message' => 'CPF Inválido'],
            [['visualizacao_candidatos', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas'], 'safe'],
            [['nome', 'username', 'password_hash', 'password_reset_token', 'email', 'endereco'], 'string', 'max' => 255],
            [['auth_key', 'cargo', 'turno'], 'string', 'max' => 32],
            [['unidade'], 'string', 'max' => 60],
            [['formacao'], 'string', 'max' => 300],
            [['resumo'], 'string'],
            [['nivel'], 'string', 'max' => 6],
            [['siape', 'dataIngresso','regime','ultimaAtualizacao'], 'string', 'max' => 10],
            [['telcelular', 'telresidencial', 'titulacao', 'classe', 'alias'], 'string', 'max' => 20],
            [['administrador', 'coordenador', 'secretaria', 'professor', 'aluno'], 'string', 'max' => 1],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'username' => 'CPF',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Updated At',
            'visualizacao_candidatos' => 'Visualizacao Candidatos',
            'visualizacao_candidatos_finalizados' => 'Visualizacao Candidatos Finalizados',
            'visualizacao_cartas_respondidas' => 'Visualizacao Cartas Respondidas',
            'administrador' => 'Administrador',
            'coordenador' => 'Coordenador',
            'secretaria' => 'Secretaria',
            'professor' => 'Professor',
            'aluno' => 'Aluno',
            'perfis' => 'Perfil(s)',
            'cargo' => 'Cargo',
            'dataIngresso' => 'Data de Ingresso',
            'telcelular' => 'Telefone Celular',
            'telresidencial' => 'Telefone Residencial',
            'unidade' => 'Unidade em que atua',
            'titulacao' => 'Titulação Máxima',
            'cargo' => 'Cargo ocupado',
            'classe' => 'Classe',
            'nivel' => 'Nível',
            'regime' => 'Regime de Dedicação',
            'turno' => 'Turno de Trabalho',
            'idLattes' => 'Código do Currículo Lattes',
            'idRH' => 'Nº de Contrato no RH',
            'alias' => 'Tag para página'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by Username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */

    public function setPassword($password){
        if($password != ""){
            return $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        } else {
            return NULL;
        }
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function checarAcesso($permissao){
        switch ($permissao) {
            case 'administrador':
                return $this->administrador;
            case 'coordenador':
                return $this->coordenador;
            case 'secretaria':
                return $this->secretaria;
            case 'professor':
                return $this->professor;
            case 'aluno':
                return $this->aluno;
            default:
                return 0;
        }
    }

    public function getPerfis(){
        $perfis = [];

        if($this->administrador)
            $perfis[] = "Administrador";
        if($this->secretaria)
            $perfis[] = "Secretaria";
        if($this->coordenador)
            $perfis[] = "Coordenador";
        if($this->professor)
            $perfis[] = "Professor";
        if($this->aluno)
            $perfis[] = "Aluno";

        return implode($perfis,' | ');
    }


}
