<?php

namespace common\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "orcamento".
 *
 * @property int $id
 * @property int $id_projeto
 * @property double $recurso_aprovado
 * @property string $tipo_de_parcela
 * @property double $valor_parcela
 * @property string $data_recebida
 * @property double $valor_receber
 *
 * @property Projeto $projeto
 */
class Orcamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orcamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto'], 'integer'],
            [['recurso_aprovado', 'valor_parcela', 'valor_receber'], 'double'],
            [['data_recebida'], 'safe'],
            [['tipo_de_parcela'], 'string', 'max' => 40, 'message' => 'Limite de caracteres alcançado'],
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
            'recurso_aprovado' => 'Recurso Aprovado',
            'tipo_de_parcela' => 'Tipo de Parcela',
            'valor_parcela' => 'Valor da Parcela',
            'data_recebida' => 'Data Recebida',
            'valor_receber' => 'Valor a Receber',
        ];
    }

    public function getCustoUnitarioReal(){
        $projeto = \Yii::$app->db->createCommand('SELECT * FROM projetos.projeto WHERE id=:id_projeto')
           ->bindValue(':id_projeto', $this->id_projeto)
           ->queryOne();
        return $this->custo_unitario * ($projeto['cotacao_moeda_estrangeira']);
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
          //if($this->isNewRecord){
            if($this->data_recebida != NULL){
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->data_recebida);
              $this->data_recebida = $myDateTime->format('Y-m-d 00:00:00');
            }
            return true;
        }
        return false;
    }

    public function afterFind(){
        if($this->data_recebida != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->data_recebida);
          $this->data_recebida = $myDateTime->format('d/m/Y');
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
