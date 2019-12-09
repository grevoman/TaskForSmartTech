<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bcc_arrears_info}}`.
 */
class m191209_150959_create_bcc_arrears_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bcc_arrears_info}}', [
            'id' => $this->primaryKey(),
            'bcc' => $this->integer()->notNull(),
            'bccNameRu' => $this->string()->notNull(),
            'bccNameKz' => $this->string()->notNull(),
            'taxArrear' => $this->float()->notNull(),
            'poenaArrear' => $this->float()->notNull(),
            'percentArrear' => $this->float()->notNull(),
            'fineArrear' => $this->float()->notNull(),
            'totalArrear' => $this->float()->notNull(),
        ]);
        
        // creates index for column `bcc`
        $this->createIndex(
            'idx-bcc_arrears_info-bcc',
            'bcc_arrears_info',
            'bcc'
        );
        
        // creates index for column `bccNameRu`
        $this->createIndex(
            'idx-bcc_arrears_info-bccNameRu',
            'bcc_arrears_info',
            'bccNameRu'
        );
        
        // creates index for column `bccNameKz`
        $this->createIndex(
            'idx-bcc_arrears_info-bccNameKz',
            'bcc_arrears_info',
            'bccNameKz'
        );
                
        // add foreign key for table `tax_org_info`
        $this->addForeignKey(
            'fk-tax_payer_info-bcc_arrears_info_id',
            'tax_payer_info',
            'bcc_arrears_info_id',
            'bcc_arrears_info',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `bcc`
        $this->dropIndex(
            'idx-bcc_arrears_info-bcc',
            'bcc_arrears_info'
        ); 

        // drops index for column `bccNameRu`
        $this->dropIndex(
            'idx-bcc_arrears_info-bccNameRu',
            'bcc_arrears_info'
        ); 

        // drops index for column `bccNameKz`
        $this->dropIndex(
            'idx-bcc_arrears_info-bccNameKz',
            'bcc_arrears_info'
        ); 
        
        $this->dropTable('{{%bcc_arrears_info}}');
    }
}
