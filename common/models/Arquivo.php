<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "arquivos".
 * Esses property são apenas comentários padrão, acredito que deve ser usado por geradores
 * de documentação automática quando vasculham o código
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
     * Um atributo virtual que não está no banco e serve para guardar o arquivo
     * de anexo antes de salvar no servidor
     */
    public $arquivoFile;

    /**
     * {@inheritdoc}
     * Nome da tabela no banco a qual esse model representa
     */
    public static function tableName()
    {
        return 'arquivos';
    }

    /**
     * {@inheritdoc}
     * Validações do model, antes de um save ou update, essas regras são conferidas
     * caso não sejam seguidas o model não é salvo ou atualizado
     */
    public function rules()
    {
        return [
            [['id_projeto'], 'required'],
            [['id_projeto'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['tipo'], 'string', 'max' => 50],
            [['id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['id_projeto' => 'id']],
            // skipOnEmpty está com true pois ele deve aceitar quando o model está sem anexo
            [['arquivoFile'], 'file', 'skipOnEmpty' => true],
        ];
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
            'nome' => 'Nome',
            'tipo' => 'Tipo',
        ];
    }

    // Função responsável por salvar o arquivo de anexo no servidor
    public function upload()
    {
      // O yii2 oferece o @backend para pegar o caminho da pasta backend no servidor
      // Os dois pontos /../uploads indicam que depois de entrar na pasta backend,
      // ele deve sair da mesma para poder entrar na pasta uploads
      $this->arquivoFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/arquivo/') . $this->id . '_' . $this->id_projeto . '.' . $this->arquivoFile->extension);
      return true;
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
