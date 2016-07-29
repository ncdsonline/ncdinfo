<?php
namespace app\controllers;
use Yii;

class PrehypertensionController extends \yii\web\Controller  {
     public $enableCsrfValidation = false;
        public function actionIndex() {

        $sql = "SELECT n.HOSPCODE,n.HOSPNAME
                    ,count(*) AS 'NUM_RISK'
                    ,sum(if(NOT ISNULL(n.PRE_HT_OUTCOMES),1,0)) as 'NUM_PP'
                    ,sum(if(n.PRE_HT_OUTCOMES='1',1,0)) as 'LEVEL1'
                    ,sum(if(n.PRE_HT_OUTCOMES='2',1,0)) as 'LEVEL2'
                    ,sum(if(n.PRE_HT_OUTCOMES='3',1,0)) as 'LEVEL3'
                    ,sum(if(n.PRE_HT_OUTCOMES='4',1,0)) as 'LEVEL4'
                    ,sum(if(ISNULL(n.PRE_HT_OUTCOMES),1,0)) as 'NO_PP'
                    FROM me_ncdscreen_riskgrp n
                    WHERE ISNULL(n.HT_DATE_DX)
                    AND NOT ISNULL(n.SBP) AND NOT ISNULL(n.DBP)
                    AND n.HT_RISK='2'
                    AND n.TYPEAREA in('1','3')
                    AND n.DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150
                    GROUP BY n.HOSPCODE
                    UNION 
                    SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME
                    ,count(*) AS 'NUM_RISK'
                    ,sum(if(NOT ISNULL(n.PRE_HT_OUTCOMES),1,0)) as 'NUM_PP'
                    ,sum(if(n.PRE_HT_OUTCOMES='1',1,0)) as 'LEVEL1'
                    ,sum(if(n.PRE_HT_OUTCOMES='2',1,0)) as 'LEVEL2'
                    ,sum(if(n.PRE_HT_OUTCOMES='3',1,0)) as 'LEVEL3'
                    ,sum(if(n.PRE_HT_OUTCOMES='4',1,0)) as 'LEVEL4'
                    ,sum(if(ISNULL(n.PRE_HT_OUTCOMES),1,0)) as 'NO_PP'
                    FROM me_ncdscreen_riskgrp n
                    WHERE ISNULL(n.HT_DATE_DX)
                    AND NOT ISNULL(n.SBP) AND NOT ISNULL(n.DBP)
                    AND n.HT_RISK='2'
                    AND n.TYPEAREA in('1','3')
                    AND n.DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150;";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('index', [

                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
        ]);
    }
  
}
     ?>