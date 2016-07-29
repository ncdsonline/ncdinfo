<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeChronics;

/**
 * MeChronicsSearch represents the model behind the search form about `app\models\MeChronics`.
 */
class MeChronicsSearch extends MeChronics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'AGE'], 'integer'],
            [['HOSPCODE', 'HOSPNAME', 'PID', 'CID', 'NAME', 'LNAME', 'BIRTH', 'SEX', 'TYPEAREA', 'DISCHARGE', 'DDISCHARGE', 'HOUSE', 'VILLAGE_ID', 'MOOBAN', 'TAMBON_ID', 'TAMBON', 'AMPUR', 'CHANGWAT', 'DM_DATE_DX', 'DM_DX', 'DM_TYPEDISCH', 'HT_DATE_DX', 'HT_DX', 'HT_TYPEDISCH', 'RENAL_DATE_DX', 'RENAL_DX', 'RENAL_TYPEDISCH', 'ISCHEMIC_DATE_DX', 'ISCHEMIC_DX', 'ISCHEMIC_TYPEDISCH', 'STROKE_DATE_DX', 'STROKE_DX', 'STROKE_TYPEDISCH', 'COPD_DATE_DX', 'COPD_DX', 'COPD_TYPEDISCH', 'ASTHMA_DATE_DX', 'ASTHMA_DX', 'ASTHMA_TYPEDISCH', 'CA_DATE_DX', 'CA_DX', 'CA_TYPEDISCH'], 'safe'],
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
        $query = MeChronics::find()
        ->where(['HOSPCODE' => Yii::$app->user->identity->profile->office_id])
        ->andWhere(['DISCHARGE'=>'9'])
             ->orderBy([
	       'VILLAGE_ID'=>SORT_ASC,
	       'HOUSE' => SORT_ASC,
		])   ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $dataProvider->setSort([
//            'attributes' => [
//                //'id',
//                'VILLAGE_ID' => [
//                   // 'asc' => ['priority' => SORT_ASC],
//                    'desc' => ['VILLAGE_ID' => SORT_DESC],
//                  //  'label' => 'Priority',
//                 //   'default' => SORT_ASC
//                ],
//            ]
//        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           // $query->where('HOSPCODE=Yii::$app->user->identity->profile->office_id');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'BIRTH' => $this->BIRTH,
            'AGE' => $this->AGE,
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
            ->andFilterWhere(['like', 'VILLAGE_ID', $this->VILLAGE_ID])
            ->andFilterWhere(['like', 'MOOBAN', $this->MOOBAN])
            ->andFilterWhere(['like', 'TAMBON_ID', $this->TAMBON_ID])
            ->andFilterWhere(['like', 'TAMBON', $this->TAMBON])
            ->andFilterWhere(['like', 'AMPUR', $this->AMPUR])
            ->andFilterWhere(['like', 'CHANGWAT', $this->CHANGWAT])
            ->andFilterWhere(['like', 'DM_DATE_DX', $this->DM_DATE_DX])
            ->andFilterWhere(['like', 'DM_DX', $this->DM_DX])
            ->andFilterWhere(['like', 'DM_TYPEDISCH', $this->DM_TYPEDISCH])
            ->andFilterWhere(['like', 'HT_DATE_DX', $this->HT_DATE_DX])
            ->andFilterWhere(['like', 'HT_DX', $this->HT_DX])
            ->andFilterWhere(['like', 'HT_TYPEDISCH', $this->HT_TYPEDISCH])
            ->andFilterWhere(['like', 'RENAL_DATE_DX', $this->RENAL_DATE_DX])
            ->andFilterWhere(['like', 'RENAL_DX', $this->RENAL_DX])
            ->andFilterWhere(['like', 'RENAL_TYPEDISCH', $this->RENAL_TYPEDISCH])
            ->andFilterWhere(['like', 'ISCHEMIC_DATE_DX', $this->ISCHEMIC_DATE_DX])
            ->andFilterWhere(['like', 'ISCHEMIC_DX', $this->ISCHEMIC_DX])
            ->andFilterWhere(['like', 'ISCHEMIC_TYPEDISCH', $this->ISCHEMIC_TYPEDISCH])
            ->andFilterWhere(['like', 'STROKE_DATE_DX', $this->STROKE_DATE_DX])
            ->andFilterWhere(['like', 'STROKE_DX', $this->STROKE_DX])
            ->andFilterWhere(['like', 'STROKE_TYPEDISCH', $this->STROKE_TYPEDISCH])
            ->andFilterWhere(['like', 'COPD_DATE_DX', $this->COPD_DATE_DX])
            ->andFilterWhere(['like', 'COPD_DX', $this->COPD_DX])
            ->andFilterWhere(['like', 'COPD_TYPEDISCH', $this->COPD_TYPEDISCH])
            ->andFilterWhere(['like', 'ASTHMA_DATE_DX', $this->ASTHMA_DATE_DX])
            ->andFilterWhere(['like', 'ASTHMA_DX', $this->ASTHMA_DX])
            ->andFilterWhere(['like', 'ASTHMA_TYPEDISCH', $this->ASTHMA_TYPEDISCH])
            ->andFilterWhere(['like', 'CA_DATE_DX', $this->CA_DATE_DX])
            ->andFilterWhere(['like', 'CA_DX', $this->CA_DX])
            ->andFilterWhere(['like', 'CA_TYPEDISCH', $this->CA_TYPEDISCH]);

        return $dataProvider;
    }
}
