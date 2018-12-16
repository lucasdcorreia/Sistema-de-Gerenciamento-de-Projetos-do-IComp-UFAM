<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conta_corrente".
 * Esses property são apenas comentários padrão, acredito que deve ser usado por geradores
 * de documentação automática quando vasculham o código
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
     * Um atributo virtual que não está no banco e serve para guardar o arquivo
     * de anexo antes de salvar no servidor
     */
    public $contaFile;

    /**
     * {@inheritdoc}
     * Nome da tabela no banco a qual esse model representa
     */
    public static function tableName()
    {
        return 'conta_corrente';
    }

    /**
     * {@inheritdoc}
     * Validações do model, antes de um save ou update, essas regras são conferidas
     * caso não sejam seguidas o model não é salvo ou atualizado
     */
    public function rules()
    {
        return [
            [['id_projeto', 'tipo_conta_corrente'], 'integer'],
            [['banco'], 'string', 'max' => 50, 'message' => 'Limite de caracteres alcançado'],
            [['agencia'], 'string', 'max' => 10, 'message' => 'Limite de caracteres alcançado'],
            [['conta'], 'string', 'max' => 15, 'message' => 'Limite de caracteres alcançado'],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
            // skipOnEmpty está com true pois ele deve aceitar quando o model está sem anexo
            [['contaFile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    // Função responsável por salvar o arquivo de anexo no servidor
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
     * Aqui ficam as definições de títulos dos atributos,
     * basicamente significa que na visualização os atributos
     * terão esse nomes: ID, Id Projeto, Nome, Tipo e não id_projeto e etc
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
     * Gerada automaticamente para relacionar a chave estrangeira $id_projeto
     * com o model de Projetos
     */
    public function getProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id' => 'id_projeto']);
    }
}
