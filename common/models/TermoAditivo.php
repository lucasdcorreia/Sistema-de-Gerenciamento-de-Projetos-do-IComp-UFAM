<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "termo_aditivo".
 *
 * @property int $id
 * @property string $numero_do_termo
 * @property string $motivo
 * @property string $vigencia
 * @property int $id_projeto
 *
 * @property Projeto $projeto
 */
class TermoAditivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'termo_aditivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo'], 'string'],
            [['vigencia'], 'safe'],
            [['id_projeto'], 'integer'],
            [['numero_do_termo'], 'string', 'max' => 50],
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
            'numero_do_termo' => 'Numero Do Termo',
            'motivo' => 'Motivo',
            'vigencia' => 'Vigencia',
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
