<?php

namespace common\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "relatorio_prestacao".
 *
 * @property int $id
 * @property string $data_prevista
 * @property string $data_enviada
 * @property string $tipo
 * @property string $situacao
 * @property int $tipo_anexo
 * @property int $id_projeto
 *
 * @property Projeto $projeto
 */
class RelatorioPrestacao extends \yii\db\ActiveRecord
{
    /**
     * @var relatorioFile
     */
    public $relatorioFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relatorio_prestacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_prevista', 'data_enviada'], 'safe'],
            [['tipo_anexo', 'id_projeto'], 'integer'],
            [['tipo'], 'string', 'max' => 30, 'message' => 'Limite de caracteres alcançado'],
            [['situacao'], 'string', 'max' => 40, 'message' => 'Limite de caracteres alcançado'],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
            [['relatorioFile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_prevista' => 'Data Prevista',
            'data_enviada' => 'Data Enviada',
            'tipo' => 'Tipo',
            'situacao' => 'Situação',
            'tipo_anexo' => 'Tipo Anexo',
            'id_projeto' => 'Projeto',
        ];
    }


    public function upload()
    {
          if ($this->validate()) {
              if($this->tipo_anexo==1){
                $this->relatorioFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/relatorio_tecnico/') . $this->id . '_' . $this->id_projeto . '.' . $this->relatorioFile->extension);
                return true;
              }else if($this->tipo_anexo==2){
                $this->relatorioFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/prestacao_conta/') . $this->id . '_' . $this->id_projeto . '.' . $this->relatorioFile->extension);
                return true;
              }
          } else {
              return false;
          }
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
          //if($this->isNewRecord){
            if($this->data_prevista != NULL){
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->data_prevista);
              $this->data_prevista = $myDateTime->format('Y-m-d 00:00:00');
            }
            if($this->data_enviada != NULL){
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->data_enviada);
              $this->data_enviada = $myDateTime->format('Y-m-d 00:00:00');
            }
            return true;
        }
        return false;
    }

      public function afterFind(){
        if($this->data_prevista != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->data_prevista);
          $this->data_prevista = $myDateTime->format('d/m/Y');
        }
        if($this->data_enviada != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->data_enviada);
          $this->data_enviada = $myDateTime->format('d/m/Y');
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
