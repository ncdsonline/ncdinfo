<?php
namespace app\controllers;
use Yii;
use yii\helpers\ArrayHelper;
class ScreenncdController extends \yii\web\Controller  {
     public $enableCsrfValidation = false;
        public function actionIndex() {

        $sql = "SELECT t0.HOSPCODE
,t0.HOSPNAME
,t0.NUM_POP
,t1.NUM_DM
,t2.NUM_HT
,FORMAT((t1.NUM_DM/t0.NUM_POP*100),2) AS RATE_DM
,FORMAT((t2.NUM_HT/t0.NUM_POP*100),2) AS RATE_HT
FROM 
(
SELECT h.HOSPCODE,o.hospnamenew AS HOSPNAME,h.VILLAGE,count(*) NUM_POP
                FROM person p
                INNER JOIN home h
                ON p.HOSPCODE=h.HOSPCODE AND p.HID =h.HID 
		INNER JOIN chospital o
		ON p.HOSPCODE=o.hoscode
                WHERE p.TYPEAREA in('1','3')
                AND p.DISCHARGE='9'              
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) BETWEEN 35 AND 150
GROUP BY h.HOSPCODE
) as t0
LEFT JOIN 
(
SELECT HOSPCODE,HOSPNAME,count(*) AS  NUM_DM
FROM me_ncdscreen_riskgrp n
WHERE ISNULL(n.DM_DATE_DX)
AND NOT ISNULL(n.BSLEVEL)
AND n.TYPEAREA in('1','3')
AND n.DISCHARGE='9'  
AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150
GROUP BY HOSPCODE
) as t1 
ON t0.HOSPCODE=t1.HOSPCODE 
LEFT JOIN 
(
SELECT HOSPCODE,HOSPNAME,count(*) AS  NUM_HT
FROM me_ncdscreen_riskgrp n
WHERE ISNULL(n.HT_DATE_DX)
AND NOT ISNULL(n.SBP) AND NOT ISNULL(n.DBP)
AND n.TYPEAREA in('1','3')
AND n.DISCHARGE='9'
AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150
GROUP BY HOSPCODE
) as t2 
ON t0.HOSPCODE=t2.HOSPCODE 

UNION 

SELECT '' AS HOSPCODE
,'TOTAL' AS HOSPNAME
,t0.NUM_POP
,t1.NUM_DM
,t2.NUM_HT
,FORMAT((t1.NUM_DM/t0.NUM_POP*100),2) AS RATE_DM
,FORMAT((t2.NUM_HT/t0.NUM_POP*100),2) AS RATE_HT
FROM 
(
SELECT h.HOSPCODE,o.hospnamenew AS HOSPNAME,h.VILLAGE,count(*) NUM_POP
                FROM person p
                INNER JOIN home h
                ON p.HOSPCODE=h.HOSPCODE AND p.HID =h.HID 
		INNER JOIN chospital o
		ON p.HOSPCODE=o.hoscode
                WHERE p.TYPEAREA in('1','3')
                AND p.DISCHARGE='9'              
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) BETWEEN 35 AND 150
) as t0
LEFT JOIN 
(
SELECT HOSPCODE,HOSPNAME,count(*) AS  NUM_DM
FROM me_ncdscreen_riskgrp n
WHERE ISNULL(n.DM_DATE_DX)
AND NOT ISNULL(n.BSLEVEL)
AND n.TYPEAREA in('1','3')
AND n.DISCHARGE='9'
AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150
) as t1 
ON t0.HOSPCODE=t1.HOSPCODE 
LEFT JOIN 
(
SELECT HOSPCODE,HOSPNAME,count(*) AS  NUM_HT
FROM me_ncdscreen_riskgrp n
WHERE ISNULL(n.HT_DATE_DX)
AND NOT ISNULL(n.SBP) AND NOT ISNULL(n.DBP)
AND n.TYPEAREA in('1','3')
AND n.DISCHARGE='9'
AND TIMESTAMPDIFF(YEAR,n.BIRTH,CURDATE()) BETWEEN 35 AND 150
) as t2 
ON t0.HOSPCODE=t2.HOSPCODE ;";

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
            
       // print_r($dataProvider);
        return $this->render('index', [

                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
        ]);
    }
  
}
     ?>