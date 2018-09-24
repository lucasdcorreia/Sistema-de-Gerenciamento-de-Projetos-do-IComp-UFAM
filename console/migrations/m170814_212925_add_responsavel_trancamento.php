<?php

use yii\db\Migration;

class m170814_212925_add_responsavel_trancamento extends Migration
{
    public function safeUp()
    {
        $this->addColumn('j17_trancamentos', 'id_responsavel',
            $this->integer(11)->after('dataTermino'));

        $this->createIndex(
            'idx-trancamento-responsavel_id',
            'j17_trancamentos',
            'id_responsavel'
        );

        $this->addForeignKey(
            'fk-trancamentos-responsavel_id',
            'j17_trancamentos',
            'id_responsavel',
            'j17_user',
            'id',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        echo "m170814_212925_add_responsavel_trancamento cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170814_212925_add_responsavel_trancamento cannot be reverted.\n";

        return false;
    }
    */
}
