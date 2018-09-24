<?php

use yii\db\Migration;

class m170904_012028_cria_aluno_modifications extends Migration
{
    public function safeUp()
    {
        $this->execute("        
            CREATE TABLE `j17_aluno_modifications` (
              `id` int(11) NOT NULL,
              `id_responsavel` int(11) NOT NULL,
              `id_aluno` int(11) NOT NULL,
              `atributo` varchar(50) NOT NULL,
              `antigo_valor` varchar(2000) DEFAULT NULL,
              `novo_valor` varchar(2000) DEFAULT NULL,
              `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            ALTER TABLE `j17_aluno_modifications`
              ADD PRIMARY KEY (`id`),
              ADD KEY `id_responsavel` (`id_responsavel`),
              ADD KEY `id_responsavel_2` (`id_responsavel`),
              ADD KEY `id_aluno` (`id_aluno`);
            
            ALTER TABLE `j17_aluno_modifications`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
            
            ALTER TABLE `j17_aluno_modifications`
              ADD CONSTRAINT `fk_modificacao_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `j17_aluno` (`id`),
              ADD CONSTRAINT `fk_modificacao_responsavel` FOREIGN KEY (`id_responsavel`) REFERENCES `j17_user` (`id`);
            COMMIT;
        ");
    }

    public function safeDown()
    {
        echo "m170904_012028_cria_aluno_modifications cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170904_012028_cria_aluno_modifications cannot be reverted.\n";

        return false;
    }
    */
}
