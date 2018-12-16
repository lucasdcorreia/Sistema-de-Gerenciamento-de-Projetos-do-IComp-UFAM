<?php

namespace common\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "orcamento".
 * Esses property são apenas comentários padrão, acredito que deve ser usado por geradores
 * de documentação automática quando vasculham o código
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
     * Nome da tabela no banco a qual esse model representa
     */
    public static function tableName()
    {
        return 'orcamento';
    }

    /**
     * {@inheritdoc}
     * Validações do model, antes de um save ou update, essas regras são conferidas
     * caso não sejam seguidas o model não é salvo ou atualizado
     */
    public function rules()
    {
        return [
            [['id_projeto'], 'integer'],
            [['recurso_aprovado', 'valor_parcela', 'valor_receber'], 'double'],
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
            'recurso_aprovado' => 'Recurso Aprovado',
            'tipo_de_parcela' => 'Tipo de Parcela',
            'valor_parcela' => 'Valor da Parcela',
            'data_recebida' => 'Data Recebida',
            'valor_receber' => 'Valor a Receber',
        ];
    }

    // beforeSave, antes de salvar ou atualizar o models, essa função é executada
    public function beforeSave($insert){
      // Se for um insert, ou seja, save ou update, o que estiver no if é executado
        if(parent::beforeSave($insert)){
          //confere se a data recebida é nula, se não for,
          // ele converte ela para o formato de datetime para salvar no banco
            if($this->data_recebida != NULL){
              // Cria um datetime baseado no formato vindo da view day/month/year
              $myDateTime = DateTime::createFromFormat('d/m/Y', $this->data_recebida);
              // Converte esse DateTime para o banco, year/month/day hh:mm:ss
              // hh:mm:ss hora, minuto e segundo não importa, então fica constante zero zero
              $this->data_recebida = $myDateTime->format('Y-m-d 00:00:00');
            }
            return true;
        }
        return false;
    }

    // Sempre que um orçamento for pego do banco, ou seja,
    // após ser encontrado, a função é executada
    public function afterFind(){

      // Se data recebida não for nula
        if($this->data_recebida != NULL){
          // Cria um datetime baseado no formato vindo do banco
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->data_recebida);
          // Converte esse datetime do banco para o formato da view day/month/year
          $this->data_recebida = $myDateTime->format('d/m/Y');
        }
        parent::afterFind();
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     * Relaciona a chave estrangeira id_projeto com a tabela Projeto
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }
}
