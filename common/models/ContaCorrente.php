<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conta_corrente".
 *
 * @property int $id
 * @property int $id_projeto
 * @property string $banco
 * @property string $agencia
 * @property string $conta
 * @property int $tipo_conta_corrente
 *
 * @property Projeto $projeto
 */
class ContaCorrente extends \yii\db\ActiveRecord
{

    /**
     * @var contaFile
     */
    public $contaFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conta_corrente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto', 'tipo_conta_corrente'], 'integer'],
            [['banco'], 'string', 'max' => 50, 'message' => 'Limite de caracteres alcançado'],
            [['agencia'], 'string', 'max' => 10, 'message' => 'Limite de caracteres alcançado'],
            [['conta'], 'string', 'max' => 15, 'message' => 'Limite de caracteres alcançado'],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
            [['contaFile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    public function upload()
    {
          if ($this->validate()) {
              if($this->tipo_conta_corrente==1){
                $this->contaFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/conta_corrente/desembolso/') . $this->id . '_' . $this->id_projeto . '.' . $this->contaFile->extension);
                return true;
              }else if($this->tipo_conta_corrente==2){
                $this->contaFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/conta_corrente/recolhimento/') . $this->id . '_' . $this->id_projeto . '.' . $this->contaFile->extension);
                return true;
              }
          } else {
              return false;
          }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_projeto' => 'Id Projeto',
            'banco' => 'Banco',
            'agencia' => 'Agência',
            'conta' => 'Conta',
            'tipo_conta_corrente' => 'Tipo Conta Corrente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }
}
