<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeChronicregist;

/**
 * MeChronicregistSearch represents the model behind the search form about `app\models\MeChronicregist`.
 */
class MeChronicregistSearch extends MeChronicregist
{
    /**
     * @inheritdoc
     */
    public $dateexam;
     
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['HN_HMAIN', 'HOSPCODE', 'HOSPNAME', 
                'PID', 'CID', 'NAME', 'LNAME', 'BIRTH', 
                'AGE', 'SEX', 'TYPEAREA', 'DISCHARGE',
                'DDISCHARGE', 'HOUSE', 'VILLAGE_ID',
                'MOOBAN', 
              //  'AMPUR', 'CHANGWAT'
              //  'MAININSCL',
                'DM_DATE_DX', 'DM_DX', 'DM_TYPEDISCH',
                'HT_DATE_DX', 'HT_DX', 'HT_TYPEDISCH', 
                'RENAL_DATE_DX', 'RENAL_DX', 'RENAL_TYPEDISCH',
                'ISCHEMIC_DATE_DX', 'ISCHEMIC_DX', 'ISCHEMIC_TYPEDISCH',
                'STROKE_DATE_DX', 'STROKE_DX', 'STROKE_TYPEDISCH', 
                'COPD_DATE_DX', 'COPD_DX', 'COPD_TYPEDISCH', 
                'ASTHMA_DATE_DX', 'ASTHMA_DX', 'ASTHMA_TYPEDISCH', 
                'CA_BREAST_DATE_DX', 'CA_BREAST_DX', 'CA_BREAST_TYPEDISCH',
                'CA_CERVIX_DATE_DX', 'CA_CERVIX_DX', 'CA_CERVIX_TYPEDISCH',
                'CA_COLON_DATE_DX', 'CA_COLON_DX', 'CA_COLON_TYPEDISCH', 'UPDATE_AT'], 'safe'],
            [['dateexam'], 'required'],
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
        $query = MeChronicregist::find()
        ->where(['HOSPCODE' => Yii::$app->user->identity->profile->office_id])
        ->andWhere(['DISCHARGE'=>'9'])
        ->Having(['not', ['DM_DX' => null]])  
        ->orHaving(['not', ['HT_DX' => null]]) 
        ->orderBy([
	       'VILLAGE_ID'=>SORT_ASC,
	       'HOUSE' => SORT_ASC,
		])   ;
         //->addOrderBy('NAME ASC');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
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

        $query->andFilterWhere(['like', 'HN_HMAIN', $this->HN_HMAIN])
            ->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'HOSPNAME', $this->HOSPNAME])
            ->andFilterWhere(['like', 'PID', $this->PID])
            ->andFilterWhere(['like', 'CID', $this->CID])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'LNAME', $this->LNAME])
            ->andFilterWhere(['like', 'AGE', $this->AGE])
            ->andFilterWhere(['like', 'SEX', $this->SEX])
            ->andFilterWhere(['like', 'TYPEAREA', $this->TYPEAREA])
            ->andFilterWhere(['like', 'DISCHARGE', $this->DISCHARGE])
            ->andFilterWhere(['like', 'HOUSE', $this->HOUSE])
            ->andFilterWhere(['like', 'VILLAGE_ID', $this->VILLAGE_ID])
            ->andFilterWhere(['like', 'MOOBAN', $this->MOOBAN])
        //    ->andFilterWhere(['like', 'TAMBON_ID', $this->TAMBON_ID])
         //   ->andFilterWhere(['like', 'TAMBON', $this->TAMBON])
          //  ->andFilterWhere(['like', 'AMPUR', $this->AMPUR])
      //      ->andFilterWhere(['like', 'CHANGWAT', $this->CHANGWAT])
            ->andFilterWhere(['like', 'MAININSCL', $this->MAININSCL])
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
            ->andFilterWhere(['like', 'CA_BREAST_DATE_DX', $this->CA_BREAST_DATE_DX])
            ->andFilterWhere(['like', 'CA_BREAST_DX', $this->CA_BREAST_DX])
            ->andFilterWhere(['like', 'CA_BREAST_TYPEDISCH', $this->CA_BREAST_TYPEDISCH])
            ->andFilterWhere(['like', 'CA_CERVIX_DATE_DX', $this->CA_CERVIX_DATE_DX])
            ->andFilterWhere(['like', 'CA_CERVIX_DX', $this->CA_CERVIX_DX])
            ->andFilterWhere(['like', 'CA_CERVIX_TYPEDISCH', $this->CA_CERVIX_TYPEDISCH])
            ->andFilterWhere(['like', 'CA_COLON_DATE_DX', $this->CA_COLON_DATE_DX])
            ->andFilterWhere(['like', 'CA_COLON_DX', $this->CA_COLON_DX])
            ->andFilterWhere(['like', 'CA_COLON_TYPEDISCH', $this->CA_COLON_TYPEDISCH])
            ->andFilterWhere(['like', 'UPDATE_AT', $this->UPDATE_AT]);

        return $dataProvider;
    }
}
