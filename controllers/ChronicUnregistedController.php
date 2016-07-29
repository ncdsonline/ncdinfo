<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use app\models\ChronicSearchForm;


class ChronicUnregistedController extends Controller
{
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
                      'actions'=>['index','view','list'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }
    public function actionIndex() {
        
        $sql = "SELECT HOSPCODE,HOSPNAME,N FROM (
                    SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME,count(*) N
                                    FROM chospital h
                                    LEFT  JOIN me_op_chronic o 
                                    ON o.HOSPCODE=h.hoscode
                                    WHERE h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                                    AND ISNULL(o.FLAG_CHRONIC)  
                                    AND  NOT ISNULL(o.CHRONIC_DX)
                                    AND o.TYPEAREA in('1','3')
                                    GROUP BY o.HOSPCODE
                                    ORDER BY h.subdistcode,h.hoscode
                    ) as t1
                    UNION 
                    SELECT HOSPCODE,HOSPNAME,N FROM (
                    SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME,count(*) N
                                    FROM chospital h
                                    LEFT  JOIN me_op_chronic o 
                                    ON o.HOSPCODE=h.hoscode
                                    WHERE h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                                    AND ISNULL(o.FLAG_CHRONIC)  
                                    AND  NOT ISNULL(o.CHRONIC_DX)
                                    AND o.TYPEAREA in('1','3')
                    ) as t2 ;";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'HOSPCODE',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            //'HOSPCODE'=>$HOSPCODE,
           
        ]);
        
    }

    
     public function actionList() {
        if(!empty(Yii::$app->request->get('HOSPCODE'))){
            $hospcode =Yii::$app->request->get('HOSPCODE') ;
        }
        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {

        $sql = "SELECT person.CID,person.`NAME`,person.LNAME,person.BIRTH,person.SEX
                ,home.HOUSE,home.VILLAGE 
                ,me_op_chronic.HCODE,me_op_chronic.HN,me_op_chronic.LAST_VISITDATE,me_op_chronic.CHRONIC_DX 
                FROM person 
                INNER JOIN home 
                ON person.HOSPCODE=home.HOSPCODE AND person.HID=home.HID 
                INNER JOIN me_op_chronic
                ON person.HOSPCODE=me_op_chronic.HOSPCODE AND person.PID=me_op_chronic.PID
                WHERE person.HOSPCODE='".$hospcode."' AND ISNULL(me_op_chronic.FLAG_CHRONIC) AND NOT ISNULL(CHRONIC_DX)
                ORDER BY home.VILLAGE,home.HOUSE;";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
           
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