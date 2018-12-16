<?php

namespace common\models;

use Yii;
use DateTime;
use DateInterval;
/**
 * This is the model class for table "projeto".
 * Esses property são apenas comentários padrão, acredito que deve ser usado por geradores
 * de documentação automática quando vasculham o código
 * @property int $id
 * @property string $num_processo
 * @property string $inicio_previsto
 * @property string $termino
 * @property string $nome_coordenador
 * @property string $edital
 * @property string $titulo_projeto
 * @property string $num_protocolo
 * @property double $cotacao_moeda_estrangeira
 * @property string $numero_fapeam_outorga
 * @property string $publicacao_diario_oficial
 *
 * @property Item[] $items
 * @property Receita[] $receitas
 * @property RelatorioPrestacao[] $relatorioPrestacaos
 * @property TermoAditivo[] $termoAditivos
 */
class Projeto extends \yii\db\ActiveRecord
{
    // atributo virtual "duracao"
    private $duracao;

    /**
     * @var EditalFile
     * Um atributo virtual que não está no banco e serve para guardar o arquivo
     * de anexo antes de salvar no servidor
     */
    public $editalFile;

    /**
     * @var tituloProjetoFile
     * Um atributo virtual que não está no banco e serve para guardar o arquivo
     * de anexo antes de salvar no servidor
     */
    public $tituloProjetoFile;


    /**
     * {@inheritdoc}
     * Nome da tabela no banco a qual esse model representa
     */
    public static function tableName()
    {
        return 'projeto';
    }

    /**
     * {@inheritdoc}
     * Validações do model, antes de um save ou update, essas regras são conferidas
     * caso não sejam seguidas o model não é salvo ou atualizado
     */
    public function rules()
    {
        return [
            [['inicio_previsto', 'termino'], 'date', 'format' => 'dd/mm/yyyy'],
            [['cotacao_moeda_estrangeira'], 'double'],
            [['num_processo', 'num_protocolo'], 'string', 'max' => 100, 'message' => 'Limite de caracteres alcançado'],
            [['nome_coordenador', 'edital', 'titulo_projeto', 'numero_fapeam_outorga'], 'string', 'max' => 200, 'message' => 'Limite de caracteres alcançado'],
            [['duracao'], 'safe'],
            [['editalFile'], 'file', 'skipOnEmpty' => true, 'maxSize' => 1024*1024*1024*1024*1024, 'tooBig' => 'Arquivo é muito grande para o upload'],
            [['tituloProjetoFile'], 'file', 'skipOnEmpty' => true, 'maxSize' => 1024*1024*1024*1024, 'tooBig' => 'Arquivo é muito grande para o upload'],
            // Chamando validação manual feita para data termino e início
            ['termino', 'validateDataInicioTermino', 'enableClientValidation' => 'false']
            //['termino', 'compare', 'compareAttribute'=>'inicio_previsto', 'operator'=>'>', 'enableClientValidation' => 'false', 'message'=>'A data de início previsto deve ser anterior à data de término.'],
        ];
    }

    // Validação própria criada para data inicio e data de término
    public function validateDataInicioTermino(){
      // Caso inicio e termino não sejam nulos
      if($this->inicio_previsto != NULL && $this->termino != NULL){
        // Cria datetime baseado no início e termino
        $inicio = DateTime::createFromFormat('d/m/Y', $this->inicio_previsto);
        $fim = DateTime::createFromFormat('d/m/Y', $this->termino);
        // Confere se fim é menor que término
        if($inicio >= $fim){
          // Se fim for menor que início, lança um erro de validação
          $this->addError('termino', 'A data de término deve ser maior que a de início.');
          $this->addError('termino', 'A data de início deve ser menor que a de término.');
        }
      }
    }

    // Salva o anexo do form no banco
    // Recebe um parâmetro $tipo, indicando se é para salva o edital ou o titulo_projeto
    public function upload($tipo)
    {

      if($tipo=='edital'){
        $this->editalFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/edital/') . $this->id . '.' . $this->editalFile->extension);
        return true;
      }else if ($tipo=='titulo_projeto'){
              $this->tituloProjetoFile->saveAs(\Yii::getAlias('@backend/../uploads/projetos/titulo_projeto/') . $this->id . '.' . $this->tituloProjetoFile->extension);
              return true;
      }else return false;

    }

    // beforeSave, antes de salvar ou atualizar o models, essa função é executada
    public function beforeSave($insert){
      // Se for um insert, ou seja, save ou update, o que estiver no if é executado
      if(parent::beforeSave($insert)){
        // Pega as datas e converte o formato day/month/year para o
        // formato year/month/day para o banco
        if($this->inicio_previsto != NULL){
          $myDateTime = DateTime::createFromFormat('d/m/Y', $this->inicio_previsto);
          $this->inicio_previsto = $myDateTime->format('Y-m-d 00:00:00');
        }
        if($this->termino != NULL){
          $myDateTime = DateTime::createFromFormat('d/m/Y', $this->termino);
          $this->termino = $myDateTime->format('Y-m-d 00:00:00');
        }
        if($this->publicacao_diario_oficial != NULL){
          $myDateTime = DateTime::createFromFormat('d/m/Y', $this->publicacao_diario_oficial);
          $this->publicacao_diario_oficial = $myDateTime->format('Y-m-d 00:00:00');
        }
        return true;
      }
      return false;
    }

    // Sempre que um orçamento for pego do banco, ou seja,
    // após ser encontrado, a função é executada
    public function afterFind(){
        //Converte do formato do banco year/month/day para a view day/month/year
        if($this->inicio_previsto != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->inicio_previsto);
          $this->inicio_previsto = $myDateTime->format('d/m/Y');
        }
        if($this->termino != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->termino);
          $this->termino = $myDateTime->format('d/m/Y');
        }
        if($this->publicacao_diario_oficial != NULL){
          $myDateTime = DateTime::createFromFormat('Y-m-d H:i:00', $this->publicacao_diario_oficial);
          $this->publicacao_diario_oficial = $myDateTime->format('d/m/Y');
        }
        parent::afterFind();
        return true;
    }

    //Atributo virtual/calculado "duracao"
    public function getDuracao(){
      $anos = 0;
      $meses = 0;
      $dias = 0;
      $this->duracao = '';
      if($this->inicio_previsto != NULL && $this->termino != NULL){
        $begin = DateTime::createFromFormat('d/m/Y', $this->inicio_previsto);
        $end = DateTime::createFromFormat('d/m/Y', $this->termino);

        $diff = $end->diff($begin);
        $anos = intval($diff->format('%y'));
        $meses = intval($diff->format('%m'));
        $dias = intval($diff->format('%d'));
        if($anos>0)
          $this->duracao = $anos > 1 ? $diff->format('%y anos') : $diff->format('%y ano');
        if($meses>0){
          if($anos>0)
            $this->duracao = $this->duracao . ', ';
          $this->duracao = $meses > 1 ? $this->duracao . $diff->format('%m meses') : $this->duracao . $diff->format('%m mês');
        }
        if($dias>0){
          if($anos>0 || $meses>0)
            $this->duracao = $this->duracao . ' e ';
          $this->duracao = $dias > 1 ?  $this->duracao . $diff->format('%d dias') : $this->duracao . $diff->format('%d dia');
        }
        if($dias==0 && $meses==0 && $anos==0)
          $this->duracao = '0 dias';
      }else $this->duracao = '0 dias';

      return $this->duracao;
    }

    /**
    * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_processo' => 'Número do Processo',
            'inicio_previsto' => 'Início Previsto',
            'termino' => 'Término',
            'nome_coordenador' => 'Coordenador',
            'edital' => 'Edital',
            'titulo_projeto' => 'Título do Projeto',
            'num_protocolo' => 'Número do Protocolo',
            'cotacao_moeda_estrangeira' => 'Cotação da Moeda Estrangeira',
            'numero_fapeam_outorga' => 'Número da FAPEAM',
            'duracao' => 'Duração',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceitas()
    {
        return $this->hasMany(Receita::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelatorioPrestacaos()
    {
        return $this->hasMany(RelatorioPrestacao::className(), ['id_projeto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermoAditivos()
    {
        return $this->hasMany(TermoAditivo::className(), ['id_projeto' => 'id']);
    }
}
