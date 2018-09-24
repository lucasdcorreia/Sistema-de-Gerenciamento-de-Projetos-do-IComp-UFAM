<?php

use yii\db\Migration;

class m170815_004422_add_data_term_prorrogacao extends Migration
{
    public function safeUp()
    {
        $this->addColumn('j17_prorrogacoes', 'data_termino',
            $this->date()->after('dataInicio'));
    }

    public function safeDown()
    {
        echo "m170815_004422_add_data_term_prorrogacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170815_004422_add_data_term_prorrogacao cannot be reverted.\n";

        return false;
    }
    */
}
