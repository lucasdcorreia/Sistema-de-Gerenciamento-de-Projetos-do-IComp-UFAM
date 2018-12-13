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
    private $custoUnitarioReal;
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
            [['justificativa', 'descricao', 'professor_responsavel'], 'string'],
            [['quantidade', 'tipo_item', 'id_projeto'], 'integer'],
            [['natureza'], 'string', 'max' => 40, 'message' => 'Limite de caracteres alcançado'],
            [['custoUnitarioReal'], 'safe'],
            [['numero_item'], 'string', 'max' => 100, 'message' => 'Limite de caracteres alcançado'],
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
            'numero_item' => 'Nº Item',
            'justificativa' => 'Justificativa',
            'quantidade' => 'Quantidade',
            'custo_unitario' => 'Custo Unitário',
            'custoUnitarioReal' => 'Custo Unitário(R$)',
            'tipo_item' => 'Tipo de Item',
            'descricao' => 'Descrição',
            'id_projeto' => 'Id Projeto',
            'professor_responsavel' => 'Prof. Responsável',
        ];
    }

    public function getCustoUnitarioReal(){
        $projeto = \Yii::$app->db->createCommand('SELECT * FROM projetos.projeto WHERE id=:id_projeto')
           ->bindValue(':id_projeto', $this->id_projeto)
           ->queryOne();
        return $this->custo_unitario * ($projeto['cotacao_moeda_estrangeira']);
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
