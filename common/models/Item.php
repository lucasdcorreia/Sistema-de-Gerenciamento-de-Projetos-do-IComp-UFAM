<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item".
 * Esses property são apenas comentários padrão, acredito que deve ser usado por geradores
 * de documentação automática quando vasculham o código
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

    // atributo virtual/atributo calculado, para pegar o custo unitário
    // convertido para real
    private $custoUnitarioReal;
    /**
     * {@inheritdoc}
     * Nome da tabela no banco a qual esse model representa
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     * Validações do model, antes de um save ou update, essas regras são conferidas
     * caso não sejam seguidas o model não é salvo ou atualizado
     */
    public function rules()
    {
        return [
            [['custo_unitario'], 'double'],
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
     * Aqui ficam as definições de títulos dos atributos,
     * basicamente significa que na visualização os atributos
     * terão esse nomes: Natureza, Nº Item e etc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'natureza' => 'Natureza',
            //'valor' => 'Valor',
            'numero_item' => 'Nº Item',
            'justificativa' => 'Justificativa',
            'quantidade' => 'Qtde.',
            'custo_unitario' => 'Custo Unitário',
            'custoUnitarioReal' => 'Custo Unitário(R$)',
            'tipo_item' => 'Tipo de Item',
            'descricao' => 'Descrição',
            'id_projeto' => 'Id Projeto',
            'professor_responsavel' => 'Prof. Responsável',
        ];
    }

    // Como o nome sugere beforeSave é uma função chamada
    // antes de salvar um model no banco
    public function beforeSave($insert){
      // Nesse caso, não há restrição caso seja um update ou save,
      // qualquer que seja a inserção o que há dentro do if será executado
      if(parent::beforeSave($insert)){
        // Caso a quantidade não seja especificada, e o custo unitário sim
        // a quantidade é setada para 1, assim o calculo do total não dá zero
        // na multiplicação
          if($this->quantidade == NULL && $this->custo_unitario != NULL){
            $this->quantidade = 1;
          }
          return true;
      }
      return false;
    }

    // Como custo unitário é um atributo virtual/calculado
    // quando chamarmos ele no controle ou view, o yii2 vai procurar por
    // um método com o nome getCustoUnitarioReal, repara que ele entende que custo
    // vai estar com a primeira letra maiúscula
    public function getCustoUnitarioReal(){
      // Isso é uma consulta direta no banco que pega a cotacao do dólar no projeto relacionado a esse item
        $projeto = \Yii::$app->db->createCommand('SELECT * FROM projetos.projeto WHERE id=:id_projeto')
           ->bindValue(':id_projeto', $this->id_projeto)
           ->queryOne();
       // Converte custo_unitario para real, ou seja para o custoUnitarioReal
        return $this->custo_unitario * ($projeto['cotacao_moeda_estrangeira']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * Relacionando com a chave estrangeira id_item, com a tabela Despesa
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['id_item' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * Relacionando a chave estrangeira id_projeto com a tabela Projeto
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
