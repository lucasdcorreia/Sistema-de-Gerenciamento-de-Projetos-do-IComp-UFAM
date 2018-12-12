<?php

namespace common\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "valor_pago".
 *
 * @property int $id
 * @property int $id_projeto
 * @property string $numero_ob
 * @property string $data
 * @property string $natureza
 * @property double $valor
 * @property string $tipo
 *
 * @property Projeto $projeto
 */
class ValorPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valor_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto'], 'integer'],
            [['data'], 'safe'],
            [['valor'], 'number'],
            [['numero_ob'], 'string', 'max' => 30, 'message' => 'Limite de caracteres alcançado'],
            [['natureza', 'tipo'], 'string', 'max' => 40, 'message' => 'Limite de caracteres alcançado'],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_projeto' => 'Id Projeto',
            'numero_ob' => 'Nº O.B.',
            'data' => 'Data',
            'natureza' => 'Natureza da Despesa',
            'valor' => 'Valor',
            'tipo' => 'Tipo',
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
          //if($this->isNewRecord){
            if($this->data != NULL){
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->data);
              $this->data = $myDateTime->format('Y-m-d 00:00:00');
            }
            return true;
        }
        return false;
    }

    public function afterFind(){
        if($this->data != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->data);
          $this->data = $myDateTime->format('d/m/Y');
        }
        parent::afterFind();
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }
}
