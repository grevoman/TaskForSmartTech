<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tax_payer_info}}`.
 */
class m191209_145010_create_tax_payer_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tax_payer_info}}', [
            'id' => $this->primaryKey(),
            'nameRu' => $this->string()->notNull(),
            'nameKk' => $this->string()->notNull(),
            'iinBin' => $this->bigInteger()->notNull(),
            'totalArrear' => $this->float()->notNull(),
            'bcc_arrears_info_id' => $this->integer(),
       ]);
        
        // creates index for column `nameRu`
        $this->createIndex(
            'idx-tax_payer_info-nameRu',
            'tax_payer_info',
            'nameRu'
        );
        
        // creates index for column `nameKk`
        $this->createIndex(
            'idx-tax_payer_info-nameKk',
            'tax_payer_info',
            'nameKk'
        );
        
        // creates index for column `iinBin`
        $this->createIndex(
            'idx-tax_payer_info-iinBin',
            'tax_payer_info',
            'iinBin'
        );
        
        // add foreign key for table `tax_org_info`
        $this->addForeignKey(
            'fk-tax_org_info-tax_payer_info_id',
            'tax_org_info',
            'tax_payer_info_id',
            'tax_payer_info',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `nameRu`
        $this->dropIndex(
            'iidx-tax_payer_info-nameRu',
            'tax_payer_info'
        );        

        // drops index for column `nameKk`
        $this->dropIndex(
            'iidx-tax_payer_info-nameKk',
            'tax_payer_info'
        );        

        // drops index for column `iinBin`
        $this->dropIndex(
            'iidx-tax_payer_info-iinBin',
            'tax_payer_info'
        );        
        
        // drops foreign key for table `tax_payer_info`
        $this->dropForeignKey(
            'fk-tax_payer_info-bcc_arrears_info_id',
            'tax_payer_info'
        );       

        $this->dropTable('{{%tax_payer_info}}');
    }
}
