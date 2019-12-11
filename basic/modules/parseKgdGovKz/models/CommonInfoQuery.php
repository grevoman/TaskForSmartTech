<?php

namespace app\modules\parseKgdGovKz\models;

/**
 * This is the ActiveQuery class for [[CommonInfo]].
 *
 * @see CommonInfo
 */
class CommonInfoQuery extends \yii\db\ActiveQuery
{
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CommonInfo[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CommonInfo|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}