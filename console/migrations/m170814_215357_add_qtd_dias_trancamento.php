<?php

use yii\db\Migration;

class m170814_215357_add_qtd_dias_trancamento extends Migration
{
    public function safeUp()
    {
        $this->addColumn('j17_trancamentos', 'qtd_dias',
            $this->integer(11)->after('justificativa'));
    }

    public function safeDown()
    {
        echo "m170814_215357_add_qtd_dias_trancamento cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170814_215357_add_qtd_dias_trancamento cannot be reverted.\n";

        return false;
    }
    */
}
