<?php

namespace common\models;

use Yii;

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
            [['tipo'], 'string', 'max' => 30],
            [['situacao'], 'string', 'max' => 40],
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
            'data_prevista' => 'Data Prevista',
            'data_enviada' => 'Data Enviada',
            'tipo' => 'Tipo',
            'situacao' => 'Situacao',
            'tipo_anexo' => 'Tipo Anexo',
            'id_projeto' => 'Id Projeto',
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
