<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Labfu;

/**
 * LabfuSearch represents the model behind the search form about `app\models\Labfu`.
 */
class LabfuSearch extends Labfu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'PID', 'SEQ', 'DATE_SERV', 'LABTEST', 'D_UPDATE'], 'safe'],
            [['LABRESULT'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Labfu::find();
                $query->andWhere(['HOSPCODE' => Yii::$app->user->identity->profile->office_id])
                ->orderBy(['DATE_SERV' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'DATE_SERV' => $this->DATE_SERV,
            'LABRESULT' => $this->LABRESULT,
            'D_UPDATE' => $this->D_UPDATE,
        ]);

        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'PID', $this->PID])
            ->andFilterWhere(['like', 'SEQ', $this->SEQ])
            ->andFilterWhere(['like', 'LABTEST', $this->LABTEST]);

        return $dataProvider;
    }
}
