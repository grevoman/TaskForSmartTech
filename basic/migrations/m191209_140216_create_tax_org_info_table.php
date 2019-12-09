<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tax_org_info}}`.
 */
class m191209_140216_create_tax_org_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tax_org_info}}', [
            'id' => $this->primaryKey(),
            'nameRu' => $this->string()->notNull(),
            'nameKk' => $this->string()->notNull(),
            'charCode' => $this->string()->notNull(),
            'reportAcrualDate' => $this->bigInteger()->notNull(),
            'totalArrear' => $this->float()->notNull(),
            'totalTaxArrear' => $this->float()->notNull(),
            'totalTaxArrear' => $this->float()->notNull(),
            'pensionContributionArrear' => $this->float()->notNull(),
            'socialContributionArrear' => $this->float()->notNull(),
            'socialHealthInsuranceArrear' => $this->float()->notNull(),
            'appealledAmount' => $this->float(),
            'modifiedTermsAmount' => $this->float(),
            'rehabilitaionProcedureAmount' => $this->float(),
            'tax_payer_info_id' => $this->integer(),
        ]);
        
        // creates index for column `nameRu`
        $this->createIndex(
            'idx-tax_org_info-nameRu',
            'tax_org_info',
            'nameRu'
        );

        // creates index for column `nameKk`
        $this->createIndex(
            'idx-tax_org_info-nameKk',
            'tax_org_info',
            'nameKk'
        );

        // creates index for column `charCode`
        $this->createIndex(
            'idx-tax_org_info-charCode',
            'tax_org_info',
            'charCode'
        );
        
        // add foreign key for table `tax_org_info`
        $this->addForeignKey(
            'fk-common_info-tax_org_info_id',
            'common_info',
            'tax_org_info_id',
            'tax_org_info',
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
            'idx-tax_org_info-nameRu',
            'tax_org_info'
        );        

        // drops index for column `nameKk`
        $this->dropIndex(
            'idx-tax_org_info-nameKk',
            'tax_org_info'
        );        

        // drops index for column `charCode`
        $this->dropIndex(
            'idx-tax_org_info-charCode',
            'tax_org_info'
        );        
        
        // drops foreign key for table `tax_payer_info`
        $this->dropForeignKey(
            'fk-tax_org_info-tax_payer_info_id',
            'tax_org_info'
        );
        
        $this->dropTable('{{%tax_org_info}}');
    }
}
