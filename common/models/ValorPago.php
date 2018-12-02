<?php

namespace common\models;

use Yii;

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
            [['numero_ob'], 'string', 'max' => 30],
            [['natureza', 'tipo'], 'string', 'max' => 40],
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
            'numero_ob' => 'Numero Ob',
            'data' => 'Data',
            'natureza' => 'Natureza',
            'valor' => 'Valor',
            'tipo' => 'Tipo',
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
