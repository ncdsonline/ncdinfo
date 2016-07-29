<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeVisitlab;

/**
 * MeVisitlabSearch represents the model behind the search form about `app\models\MeVisitlab`.
 */
class MeVisitlabSearch extends MeVisitlab
{
    public $datestart;
    public $datestop;
     
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['ID'], 'integer'],
            // [['HOSPCODE', 'CID', 'CREATED_AT', 'CREATED_BY'], 'safe'],
            [['datestart'], 'required', 'message' => 'กรุณาระบุวันที่เริ่มต้น'],
            [['datestop'], 'required', 'message' => 'กรุณาระบุวันที่สิ้นสุด'],
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
       
        $query = MeVisitlab::find()
                ->joinWith('mechronicregist') // *** models
                ->where(['me_chronicregist.HOSPCODE'=>Yii::$app->user->identity->profile->office_id])
               // ->groupBy(['CREATED_AT','me_chronicregist.CID']) // *** table
                ->orderBy('CREATED_AT')
                ->addOrderBy('me_chronicregist.VILLAGE_ID');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // get value from datepicker       
        $query->andFilterWhere(
            ['between', 'date(CREATED_AT)', $this->datestart, $this->datestop]); // 'date(CREATED_AT)' as mysql syntax instead a variable
//        $query->andFilterWhere(['>', 'CREATED_AT', $this->datestart]);
//        $query->andFilterWhere(['<', 'CREATED_AT', $this->datestop]);
        return $dataProvider;
    }
}
