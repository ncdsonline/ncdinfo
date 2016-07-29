<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lab;

/**
 * LabSearch represents the model behind the search form about `app\models\Lab`.
 */
class LabSearch extends Lab
{
    public  $keyword;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['CID', 'SEQ', 'DATE_SERV', 'LABTEST', 'LABNAME', 'LABRESULT' 
                ,'keyword'], 'safe'],
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

        $query = Lab::find()->joinWith(['person']);
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
        ]);

        $query->andFilterWhere(['like', 'CID', $this->CID])
          //  ->andFilterWhere(['like', 'SEQ', $this->SEQ])
            ->andFilterWhere(['like', 'DATE_SERV', $this->DATE_SERV]);
//            ->andFilterWhere(['like', 'LABTEST', $this->LABTEST])
//            ->andFilterWhere(['like', 'LABNAME', $this->LABNAME])
//            ->andFilterWhere(['like', 'LABRESULT', $this->LABRESULT]);

        return $dataProvider;
    }
}
