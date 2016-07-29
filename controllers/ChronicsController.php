<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;

class ChronicsController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only'=>['list'],
//                'rules' => [
//                    [
//                      //  'actions' => ['login', 'error'], // Define specific actions
//                        'allow' => true, // Has access
//                        'roles' => ['@'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
//                    ],
////                    [
////                        'allow' => false, // Do not have access
////                        'roles'=>['?'], // Guests '?'
////                    ],
//                ],
//            ],
//        ];
//    }
    // กลุ่มโรคเรื้อรัง  4 กลุ่มโรค
     public function actionIndex() {
 $sql = "SELECT h.hoscode as HOSPCODE,h.hospnamenew as HOSPNAME
,t1.CARDIOVARCULAR
,t2.DIABETES
,t3.RESPIRATORY
,t4.CANCER
FROM chospital h
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.HT_DX) AND me_chronics.HT_TYPEDISCH='03')  
OR (NOT ISNULL(me_chronics.STROKE_DX) AND me_chronics.STROKE_TYPEDISCH='03')
OR (NOT ISNULL(me_chronics.ISCHEMIC_DX) AND me_chronics.ISCHEMIC_DX='03')
,1,0)) as CARDIOVARCULAR 
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
GROUP BY  me_chronics.HOSPCODE
) as t1 
ON h.hoscode=t1.HOSPCODE 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.DM_DX) AND me_chronics.DM_TYPEDISCH='03') ,1,0)) as DIABETES
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
GROUP BY  me_chronics.HOSPCODE
) as t2
ON h.hoscode=t2.HOSPCODE 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.ASTHMA_DX) AND me_chronics.ASTHMA_TYPEDISCH='03') OR
(NOT ISNULL(me_chronics.COPD_DX) AND me_chronics.COPD_TYPEDISCH='03') 
,1,0)) as RESPIRATORY
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
GROUP BY  me_chronics.HOSPCODE
) as t3
ON h.hoscode=t3.HOSPCODE 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.CA_DX) AND me_chronics.CA_TYPEDISCH='03'),1,0)) as CANCER 
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
GROUP BY  me_chronics.HOSPCODE
) as t4
ON h.hoscode=t4.HOSPCODE 
WHERE h.provcode='67' AND h.distcode='01'
AND h.hostype in ('03','06')
UNION 
SELECT ''  as HOSPCODE,'Total' as HOSPNAME
,t1.CARDIOVARCULAR
,t2.DIABETES
,t3.RESPIRATORY
,t4.CANCER
FROM 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.HT_DX) AND me_chronics.HT_TYPEDISCH='03')  
OR (NOT ISNULL(me_chronics.STROKE_DX) AND me_chronics.STROKE_TYPEDISCH='03')
OR (NOT ISNULL(me_chronics.ISCHEMIC_DX) AND me_chronics.ISCHEMIC_DX='03')
,1,0)) as CARDIOVARCULAR 
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
) as t1 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.DM_DX) AND me_chronics.DM_TYPEDISCH='03') ,1,0)) as DIABETES
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
) as t2
ON t1.HOSPCODE =t2.HOSPCODE 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.ASTHMA_DX) AND me_chronics.ASTHMA_TYPEDISCH='03') OR
(NOT ISNULL(me_chronics.COPD_DX) AND me_chronics.COPD_TYPEDISCH='03') 
,1,0)) as RESPIRATORY
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
) as t3
ON t1.HOSPCODE =t3.HOSPCODE 
LEFT JOIN 
(
SELECT me_chronics.HOSPCODE
,SUM(IF((NOT ISNULL(me_chronics.CA_DX) AND me_chronics.CA_TYPEDISCH='03'),1,0)) as CANCER 
FROM me_chronics 
WHERE me_chronics.TYPEAREA in('1','3')
AND me_chronics.DISCHARGE='9'
) as t4
ON t1.HOSPCODE =t4.HOSPCODE  ;";
        //    }
            
           
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
    
// ทะเบียน
     public function actionView($HOSPCODE) {
      
        if(!empty($HOSPCODE)){
            $HOSPCODE = $_GET['HOSPCODE'];
            if(!Yii::$app->user->isGuest  && Yii::$app->user->identity->profile->office_id==$HOSPCODE ){
            $sql="";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => array('pageSize' => 50),
        ]);
        
                  } else {
                      return $this->goHome();
                  }
                  
        return $this->render('view', [
            'HOSPCODE'=>$HOSPCODE,
            'dataProvider' => $dataProvider,
             ]);
        }
     }

     
}
     ?>