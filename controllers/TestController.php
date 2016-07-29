<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{
    
    public function actionIndex() {//
       

        $sql = "SELECT POP.HOSPCODE,DM.hospnamenew,POP.nPOP,DM.nDM,FORMAT((DM.nDM/POP.nPOP*100),2) as dmrate
FROM 
(
SELECT HOSPCODE,count(*) nPOP
FROM person 
WHERE TYPEAREA in ('1','3')
AND DISCHARGE='9'
AND TIMESTAMPDIFF(YEAR,person.BIRTH,CURDATE()) > 15
GROUP BY HOSPCODE
) as POP 
LEFT JOIN 
(
SELECT HOSPCODE,hospnamenew,count(*) nDm 
FROM tmp_me_whoischronic_cup 
WHERE TYPEAREA in ('1','3')
AND DISCHARGE='9'
AND NOT ISNULL(DM_DX)
AND SUBSTR(DM_TYPEDISCH,1,2)='03'
GROUP BY HOSPCODE
) as DM
ON POP.HOSPCODE=DM.HOSPCODE";



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