<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%common_info}}`.
 */
class m191209_131705_create_common_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%common_info}}', [
            'id' => $this->primaryKey(),
            'nameRu' => $this->string()->notNull(),
            'nameKk' => $this->string()->notNull(),
            'totalArrear' => $this->float()->notNull(),
            'pensionContributionArrear' => $this->float()->notNull(),
            'socialContributionArrear' => $this->float()->notNull(),
            'socialContributionArrear' => $this->float()->notNull(),
            'socialHealthInsuranceArrear' => $this->float()->notNull(),
            'appealledAmount' => $this->float(),
            'modifiedTermsAmount' => $this->float(),
            'rehabilitaionProcedureAmount' => $this->float(),
            'sendTime' => $this->text()->notNull(),
            'tax_org_info_id' => $this->integer(),
        ]);
        
        // creates index for column `nameRu`
        $this->createIndex(
            'idx-common_info-nameru',
            'common_info',
            'nameRu'
        );
        
        // creates index for column `nameKk`
        $this->createIndex(
            'idx-common_info-namekk',
            'common_info',
            'nameKk'
        );
        
        // add foreign key for table `identificator`
        $this->addForeignKey(
            'fk-common_info-common_info_id',
            'identificator',
            'common_info_id',
            'common_info',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `namekk`
        $this->dropIndex(
            'idx-common_info-namekk',
            'common_info'
        );
        
        // drops index for column `nameRu`
        $this->dropIndex(
            'idx-common_info-nameru',
            'common_info'
        );
        
        // drops foreign key for table `identificator`
        $this->dropForeignKey(
            'fk-common_info-tax_org_info_id',
            'common_info'
        );
        
        $this->dropTable('{{%common_info}}');
    }
}
