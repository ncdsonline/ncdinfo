<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Diabetes;

/**
 * DiabetesSearch represents the model behind the search form about `app\models\Diabetes`.
 */
class DiabetesSearch extends Diabetes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['HOSPCODE', 'HOSPNAME', 'PID', 'CID', 'NAME', 'LNAME', 'BIRTH', 'SEX', 'TYPEAREA', 'DISCHARGE', 'DDISCHARGE', 'HOUSE', 'VILLAGE', 'VILLAGENAME', 'TAMBON', 'SUBDISTNAME', 'AMPUR', 'CHANGWAT', 'DATE_DX', 'DX', 'TYPEDISCH', 'DATE_COMORBI', 'COMORBI', 'HOSP_RX'], 'safe'],
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
        $query = Diabetes::find();

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
            'BIRTH' => $this->BIRTH,
            'DDISCHARGE' => $this->DDISCHARGE,
        ]);

        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'HOSPNAME', $this->HOSPNAME])
            ->andFilterWhere(['like', 'PID', $this->PID])
            ->andFilterWhere(['like', 'CID', $this->CID])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'LNAME', $this->LNAME])
            ->andFilterWhere(['like', 'SEX', $this->SEX])
            ->andFilterWhere(['like', 'TYPEAREA', $this->TYPEAREA])
            ->andFilterWhere(['like', 'DISCHARGE', $this->DISCHARGE])
            ->andFilterWhere(['like', 'HOUSE', $this->HOUSE])
            ->andFilterWhere(['like', 'VILLAGE', $this->VILLAGE])
            ->andFilterWhere(['like', 'VILLAGENAME', $this->VILLAGENAME])
            ->andFilterWhere(['like', 'TAMBON', $this->TAMBON])
            ->andFilterWhere(['like', 'SUBDISTNAME', $this->SUBDISTNAME])
            ->andFilterWhere(['like', 'AMPUR', $this->AMPUR])
            ->andFilterWhere(['like', 'CHANGWAT', $this->CHANGWAT])
            ->andFilterWhere(['like', 'DATE_DX', $this->DATE_DX])
            ->andFilterWhere(['like', 'DX', $this->DX])
            ->andFilterWhere(['like', 'TYPEDISCH', $this->TYPEDISCH])
            ->andFilterWhere(['like', 'DATE_COMORBI', $this->DATE_COMORBI])
            ->andFilterWhere(['like', 'COMORBI', $this->COMORBI])
            ->andFilterWhere(['like', 'HOSP_RX', $this->HOSP_RX]);

        return $dataProvider;
    }
}
