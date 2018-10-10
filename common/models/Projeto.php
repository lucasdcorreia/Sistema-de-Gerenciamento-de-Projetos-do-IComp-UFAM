<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projeto".
 *
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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projeto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inicio_previsto', 'termino', 'publicacao_diario_oficial'], 'safe'],
            [['cotacao_moeda_estrangeira'], 'number'],
            [['num_processo', 'num_protocolo'], 'string', 'max' => 100],
            [['nome_coordenador', 'edital', 'titulo_projeto', 'numero_fapeam_outorga'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_processo' => 'Num Processo',
            'inicio_previsto' => 'Inicio Previsto',
            'termino' => 'Termino',
            'nome_coordenador' => 'Nome Coordenador',
            'edital' => 'Edital',
            'titulo_projeto' => 'Titulo Projeto',
            'num_protocolo' => 'Num Protocolo',
            'cotacao_moeda_estrangeira' => 'Cotacao Moeda Estrangeira',
            'numero_fapeam_outorga' => 'Numero Fapeam Outorga',
            'publicacao_diario_oficial' => 'Publicacao Diario Oficial',
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
