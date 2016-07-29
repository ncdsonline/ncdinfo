<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\ChronicSearchForm;


class LabDeliveryController extends \yii\web\Controller  {
    
    public $enableCsrfValidation = false;
    
        
        public function behaviors(){
        return [
//                'verbs' => [
//                    'class' => VerbFilter::className(),
//                    'actions' => [
//                        'delete' => ['post'],
//                    ],
//                ],
                'access'=>[
                  'class'=>AccessControl::className(),
                  'rules'=>[
                    [
                      'allow'=>true,
                      'actions'=>['index'],
                      'roles'=>['?']
                    ],
                    [
                      'allow'=>true,
                      'actions'=>['index','all','missed'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }


    public function actionIndex() {
        $sql="SELECT HOSPCODE,HOSPNAME,NUM_TOTAL,NUM_ACCESS,NUM_MISSED  
            FROM 
            (
                SELECT HOSPCODE,HOSPNAME,NUM_TOTAL,NUM_ACCESS,NUM_MISSED 
                FROM me_summary_lab_delivery
                ORDER BY TAMBON_ID
            ) as t0
            UNION 
            (
                SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME
                ,SUM(NUM_TOTAL) as NUM_TOTAL 
                ,SUM(NUM_ACCESS) AS NUM_ACCESS
                ,SUM(NUM_MISSED) AS  NUM_MISSED
                FROM me_summary_lab_delivery
            );";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
         
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
            
        ]);
       
    }
    
    // บัญชีรายชื่อ
    public function actionMissed() {
        if (!empty(Yii::$app->request->get())) {
            $hospcode=Yii::$app->request->get('hospcode');
        }
        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT DISTINCT CID,NAME,LNAME,SEX,AGE,HOUSE,VILLAGE_ID,DM_DX,HT_DX
                FROM 
                (
                        SELECT *
                        FROM me_monthly_service s
                        WHERE (NOT ISNULL(s.DM_DX) OR NOT ISNULL(s.HT_DX) ) AND ( s.DDISCHARGE>='2016-01-01' OR ISNULL(s.DDISCHARGE))
                        AND s.CUTPOINT BETWEEN DATE_ADD('2016-01-01', INTERVAL -12 MONTH) AND '2016-01-01'
                        AND ISNULL(s.VISITLAB) 
                        AND s.HOSPCODE='".$hospcode."'
                ) as t
                WHERE  NOT EXISTS 
                (
                        SELECT * FROM me_monthly_service 
                        WHERE (NOT ISNULL(me_monthly_service.DM_DX) OR NOT ISNULL(me_monthly_service.HT_DX) )
                        AND ( me_monthly_service.DDISCHARGE>='2016-01-01' OR ISNULL(me_monthly_service.DDISCHARGE))
                        AND me_monthly_service.CUTPOINT BETWEEN DATE_ADD('2016-01-01', INTERVAL -12 MONTH) AND '2016-01-01'
                        AND NOT ISNULL(me_monthly_service.VISITLAB)
                        AND t.CID=me_monthly_service.CID
                )
            ORDER BY VILLAGE_ID,HOUSE;";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
         
            'allModels' => $rawData,
            'pagination' => FALSE,
         
        ]);
        
        return $this->render('missed', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['index']);
        }else{
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        }
       
    }
    
    
}
     ?>