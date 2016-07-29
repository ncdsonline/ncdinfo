<?php
namespace app\controllers;
use Yii;

class DmincidenceController extends \yii\web\Controller  {
     public $enableCsrfValidation = false;
        public function actionIndex() {

        $sql = "SELECT (t1.BYEAR+543) AS BYEAR
                    ,t1.NUM_DM_TOTAL
                    ,t2.NUM_DM_GRP1
                    ,t3.NUM_DM_GRP2

                    FROM 
                    (
                    SELECT SUBSTR(c.DM_DATE_DX,1,4) AS BYEAR,count(*) NUM_DM_TOTAL
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.DM_DX)
                    AND SUBSTR(c.DM_DATE_DX,1,4) > 2002
                    AND AGE BETWEEN 0 AND 150
                    GROUP BY BYEAR
                    ) AS t1
                    LEFT  JOIN 
                    (

                    SELECT SUBSTR(c.DM_DATE_DX,1,4) AS BYEAR,count(*) NUM_DM_GRP1
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.DM_DX)
                    AND SUBSTR(c.DM_DATE_DX,1,4) > 2002
                    AND AGE BETWEEN 0 AND 34 
                    GROUP BY BYEAR
                    ) AS t2
                    ON t1.BYEAR=t2.BYEAR 
                    LEFT    JOIN 
                    (
                    SELECT SUBSTR(c.DM_DATE_DX,1,4) AS BYEAR,count(*) NUM_DM_GRP2
                    FROM me_chronics c
                    WHERE c.TYPEAREA in('1','3')
                    AND c.DISCHARGE='9'
                    AND NOT ISNULL(c.DM_DX)
                    AND SUBSTR(c.DM_DATE_DX,1,4) > 2002
                    AND AGE BETWEEN  35 AND 150
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