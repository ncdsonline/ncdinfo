<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Labupdate;

/**
 * LabupdateSearch represents the model behind the search form about `app\models\Labupdate`.
 */
class LabupdateSearch extends Labupdate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'n'], 'integer'],
            [['CID', 'DATE_SERV'], 'safe'],
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
         $query = Labupdate::find()->joinWith(['person']);
       

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
            'ID' => $this->ID,
            'n' => $this->n,
        ]);

        $query->andFilterWhere(['like', 'CID', $this->CID])
            ->andFilterWhere(['like', 'DATE_SERV', $this->DATE_SERV]);

        return $dataProvider;
    }
}
