<?php

namespace common\models;

use Yii;

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
            [['recurso_aprovado', 'valor_parcela', 'valor_receber'], 'number'],
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
            'recurso_aprovado' => 'Recurso aprovado',
            'tipo_de_parcela' => 'Tipo de parcela',
            'valor_parcela' => 'Valor da parcela',
            'data_recebida' => 'Data recebida',
            'valor_receber' => 'Valor a receber',
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
