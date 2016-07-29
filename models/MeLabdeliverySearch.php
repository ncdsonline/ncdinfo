<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeLabdelivery;

/**
 * MeLabdeliverySearch represents the model behind the search form about `app\models\MeLabdelivery`.
 */
class MeLabdeliverySearch extends MeLabdelivery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'LABRESULT'], 'integer'],
            [['CID', 'HOSPCODE', 'PID', 'SEQ', 'DATE_SERV', 'LABTEST', 'D_UPDATE', 'UPDATED_AT'], 'safe'],
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
        $query = MeLabdelivery::find()
                ->joinWith('person', false, 'LEFT JOIN')
//        $items = $query->select([
//             'person.NAME',
//      //  'me_chronicregist.LNAME',
//        ])
        ->where(['me_labdelivery.HOSPCODE'=>Yii::$app->user->identity->profile->office_id])
      //  ->andWhere(['me_chronicregist.HOSPCODE'=>Yii::$app->user->identity->profile->office_id])
  //    ->groupBy('mechronicregist.CID')
         ->all();
        

//        $query = new \yii\db\Query;
//        $command = $query->innerJoin(
//         'person',
//         `person`.`CID` = t.`CID`)
//            ->andWhere('t.`HOSPCODE` = 1')
//            ->createCommand();
//        $queryResult = $command->query();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['me_labdelivery.DATE_SERV'] = [
            'asc' => ['me_labdelivery.DATE_SERV' => SORT_ASC],
            'desc' => ['me_labdelivery.DATE_SERV' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'DATE_SERV' => $this->DATE_SERV,
//            'LABRESULT' => $this->LABRESULT,
//            'D_UPDATE' => $this->D_UPDATE,
//        ]);
//
//        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
//            ->andFilterWhere(['like', 'PID', $this->PID])
//            ->andFilterWhere(['like', 'SEQ', $this->SEQ])
//            ->andFilterWhere(['like', 'LABTEST', $this->LABTEST]);
            
        return $dataProvider;
    }
}
