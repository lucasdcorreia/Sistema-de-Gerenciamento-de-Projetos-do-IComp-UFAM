<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "arquivos".
 *
 * @property int $id
 * @property int $id_projeto
 * @property string $nome
 * @property string $tipo
 *
 * @property Projeto $projeto
 */
class Arquivo extends \yii\db\ActiveRecord
{

    /**
     * @var arquivoFile
     */
    public $arquivoFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arquivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto'], 'required'],
            [['id_projeto'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['tipo'], 'string', 'max' => 50],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
            [['arquivoFile'], 'file', 'skipOnEmpty' => true],
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
            'nome' => 'Nome',
            'tipo' => 'Tipo',
        ];
    }

    public function upload()
    {
      $this->arquivoFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/arquivo/') . $this->id . '_' . $this->id_projeto . '.' . $this->arquivoFile->extension);
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
