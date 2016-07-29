<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use kartik\alert\AlertBlock;

class HypertensionNewcaseController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
    public function behaviors()
    {
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
                      'actions'=>['index','view','list'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }
    
    public function actionIndex() {
        $sql = "SELECT HOSPCODE,HOSPNAME
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2016',1,0)) as Y2016
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2015',1,0)) as Y2015
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2014',1,0)) as Y2014
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2013',1,0)) as Y2013
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2012',1,0)) as Y2012
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2011',1,0)) as Y2011
                FROM me_chronicregist 
                GROUP BY HOSPCODE
                UNION 
                SELECT '' as HOSPCODE,'TOTAL' as HOSPNAME
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2016',1,0)) as Y2016
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2015',1,0)) as Y2015
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2014',1,0)) as Y2014
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2013',1,0)) as Y2013
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2012',1,0)) as Y2012
                ,sum(if(SUBSTR(HT_DATE_DX,1,4)='2011',1,0)) as Y2011
                FROM me_chronicregist ;";
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
                    'sql' => $sql,

        ]);
    }
    public function actionView() {
        
        $hospcode = Yii::$app->request->get('HOSPCODE');
        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql = "SELECT VILLAGE_ID,MOOBAN
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2016',1,0)) as Y2016
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2015',1,0)) as Y2015
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2014',1,0)) as Y2014
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2013',1,0)) as Y2013
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2012',1,0)) as Y2012
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2011',1,0)) as Y2011
                    FROM me_chronicregist 
                    WHERE HOSPCODE='".$hospcode."'
                    GROUP BY VILLAGE_ID
                    UNION 
                    SELECT '' AS VILLAGE_ID,'TOTAL' AS MOOBAN
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2016',1,0)) as Y2016
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2015',1,0)) as Y2015
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2014',1,0)) as Y2014
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2013',1,0)) as Y2013
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2012',1,0)) as Y2012
                    ,sum(if(SUBSTR(DM_DATE_DX,1,4)='2011',1,0)) as Y2011
                    FROM me_chronicregist 
                    WHERE HOSPCODE='".$hospcode."';";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('view', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'hospcode'=>$hospcode,

        ]);
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['index']);
        }else{
            // redirect to login
            //return $this->goBack();  
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];

        } 
    }    
}