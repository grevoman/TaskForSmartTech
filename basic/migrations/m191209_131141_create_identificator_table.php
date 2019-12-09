<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%identificator}}`.
 */
class m191209_131141_create_identificator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%identificator}}', [
            'id' => $this->primaryKey(),
            'iinBin' => $this->bigInteger()->notNull()->unique(),
            'common_info_id' => $this->integer()
        ]);
        
        // creates index for column `iinBin`
        $this->createIndex(
            'idx-identificator-iinBin',
            'identificator',
            'iinBin'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `identificator`
        $this->dropForeignKey(
            'fk-common_info-common_info_id',
            'identificator'
        );
        
        // drops index for column `iinBin`
        $this->dropIndex(
            'idx-identificator-iinBin',
            'identificator'
        );
        
        $this->dropTable('{{%identificator}}');
    }
}
