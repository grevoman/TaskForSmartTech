<?php

namespace app\modules\parseKgdGovKz\models;

use Yii;

/**
 * This is the model class for table "identificator".
 *
 * @property int $id
 * @property int $iinBin
 * @property int|null $common_info_id
 *
 * @property CommonInfo $commonInfo
 */
class Identificator extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'identificator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['iinBin'], 'required'],
            [['iinBin', 'common_info_id'], 'integer'],
            [['iinBin'], 'unique'],
            [['common_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommonInfo::className(), 'targetAttribute' => ['common_info_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'iinBin' => 'Iin Bin',
            'common_info_id' => 'Common Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonInfo() {
        return $this->hasOne(CommonInfo::className(), ['id' => 'common_info_id']);
    }

}