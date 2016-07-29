<?php
namespace app\controllers;
use Yii;

class HtincidenceController extends \yii\web\Controller  {
     public $enableCsrfValidation = false;
        public function actionIndex() {

        $sql = "SELECT (t1.BYEAR+543) AS BYEAR
                    ,t1.NUM_HT_TOTAL
                    ,t2.NUM_HT_GRP1
                    ,t3.NUM_HT_GRP2

                    FROM 
                    (
                    SELECT SUBSTR(c.HT_DATE_DX,1,4) AS BYEAR,count(*) NUM_HT_TOTAL
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.HT_DX)
                    AND SUBSTR(c.HT_DATE_DX,1,4) > 2002
                    AND AGE BETWEEN 0 AND 150
                    GROUP BY BYEAR
                    ) AS t1
                    LEFT  JOIN 
                    (
                    SELECT SUBSTR(c.HT_DATE_DX,1,4) AS BYEAR,count(*) NUM_HT_GRP1
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.HT_DX)
                    AND SUBSTR(c.HT_DATE_DX,1,4) > 2002
                    AND AGE BETWEEN 0 AND 34
                    GROUP BY BYEAR
                    ) AS t2
                    ON t1.BYEAR=t2.BYEAR 
                    LEFT    JOIN 
                    (
                    SELECT SUBSTR(c.HT_DATE_DX,1,4) AS BYEAR,count(*) NUM_HT_GRP2
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.HT_DX)
                    AND SUBSTR(c.HT_DATE_DX,1,4) > 2002
                    AND AGE > 34
                    GROUP BY BYEAR
                    ) AS t3
                    ON t1.BYEAR=t3.BYEAR;";

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