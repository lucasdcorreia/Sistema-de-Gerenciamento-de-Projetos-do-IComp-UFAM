<?php

use yii\db\Migration;

class m170814_212914_add_responsavel_prorrogacoes extends Migration
{
    public function safeUp()
    {
        $this->addColumn('j17_prorrogacoes', 'id_responsavel',
            $this->integer(11)->after('idAluno'));

        $this->createIndex(
            'idx-prorrogacao-responsavel_id',
            'j17_prorrogacoes',
            'id_responsavel'
        );

        $this->addForeignKey(
            'fk-prorrogacao-responsavel_id',
            'j17_prorrogacoes',
            'id_responsavel',
            'j17_user',
            'id',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        echo "m170814_212914_add_responsavel_prorrogacoes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170814_212914_add_responsavel_prorrogacoes cannot be reverted.\n";

        return false;
    }
    */
}
