<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $natureza
 * @property double $valor
 * @property string $numero_item
 * @property string $justificativa
 * @property int $quantidade
 * @property double $custo_unitario
 * @property int $tipo_item
 * @property string $descricao
 * @property int $id_projeto
 * @property int $professor_responsavel
 *
 * @property Despesa[] $despesas
 * @property Projeto $projeto
 * @property ItemDespesa[] $itemDespesas
 * @property Despesa[] $despesas0
 * @property ServicoMaterial $servicoMaterial
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[/*'valor', */'custo_unitario'], 'double'],
            [['justificativa', 'descricao'], 'string'],
            [['quantidade', 'tipo_item', 'id_projeto', 'professor_responsavel'], 'integer'],
            [['natureza'], 'string', 'max' => 40],
            [['numero_item'], 'string', 'max' => 100],
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
            'natureza' => 'Natureza',
            //'valor' => 'Valor',
            'numero_item' => 'Número Item',
            'justificativa' => 'Justificativa',
            'quantidade' => 'Quantidade',
            'custo_unitario' => 'Custo Unitário',
            'tipo_item' => 'Tipo de Item',
            'descricao' => 'Descrição',
            'id_projeto' => 'Id Projeto',
            'professor_responsavel' => 'Professor Responsável',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['id_item' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemDespesas()
    {
        return $this->hasMany(ItemDespesa::className(), ['id_item' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas0()
    {
        return $this->hasMany(Despesa::className(), ['id' => 'id_despesa'])->viaTable('item_despesa', ['id_item' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicoMaterial()
    {
        return $this->hasOne(ServicoMaterial::className(), ['id_item' => 'id']);
    }
}
