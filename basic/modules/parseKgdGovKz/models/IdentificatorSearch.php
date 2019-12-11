<?php

namespace app\modules\parseKgdGovKz\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\parseKgdGovKz\models\Identificator;

/**
 * IdentificatorSearch represents the model behind the search form of `app\modules\parseKgdGovKz\models\Identificator`.
 */
class IdentificatorSearch extends Identificator
{

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'iinBin', 'common_info_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Identificator::find()
                ->with('commonInfo.taxOrgInfo.taxPayerInfo.bccArrearsInfo');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'iinBin' => $this->iinBin,
            'common_info_id' => $this->common_info_id,
        ]);

        return $dataProvider;
    }

}