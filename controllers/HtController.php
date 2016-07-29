<?php
namespace app\controllers;
use app\models\PersonForm;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\ChronicSearchForm;
use yii\filters\AccessControl;

class HtController extends \yii\web\Controller  {
    
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
                      'actions'=>['index','view','list'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }

    
    public function actionIndex() {
        
        $model = new ChronicSearchForm;
        
     //    \yii\helpers\VarDumper::dump($model,10,true);
        
        if ($model->load(Yii::$app->request->get())) {
            $params=Yii::$app->request->queryParams;
             
//            print_r( $params);
//           
//           exit();
            //$disease=$params['ChronicSearchForm']['disease'];
            $year_id=$params['ChronicSearchForm']['year_id'];
            $maininscl=$params['ChronicSearchForm']['maininscl'];
            $sex=$params['ChronicSearchForm']['sex'];
            $agestart=$params['ChronicSearchForm']['agestart'];
            $agestop=$params['ChronicSearchForm']['agestop'];
           
            if($year_id==2556){
                $enddate="2012-12-31";
                $persontable='person_2556';
            }elseif($year_id==2557){
                $enddate="2013-12-31";
                $persontable='person_2557';
            }elseif($year_id==2558){
                $enddate="2014-12-31";
                $persontable='person_2558';
            }elseif($year_id==2559){
                $enddate="2015-12-31";
                $persontable='person';
            }
           
            if( $maininscl==0){
                 $inscl="(NOT ISNULL(INSCL) OR ISNULL(INSCL))";
            }elseif ($maininscl==1) {
                $inscl="(INSCL in ('UCS','WEL'))";
            }else{
                 $inscl="(INSCL NOT in ('UCS','WEL'))";
            }          
           
            if($sex==1){
               $gender="p.SEX IN ('1')";
            }elseif ($sex==2) {
                $gender="p.SEX IN ('2')";
            }else{
                $gender="p.SEX IN ('1','2')";
            }  
//            echo 'cal age at this date :  ->'.$enddate.'<br>';
//            echo 'SEX ->'.$gender.'<br>';
//            echo 'Inscl :  ->'.$inscl.'<br>';
//            echo 'start_age :  ->'.$agestart.'<br>';
//            echo 'stop_age :   ->'.$agestop.'<br>';     

//            exit();
            
        }else{
            // default value
            $persontable='person';
            $year_id=date("Y")+543;
            $enddate=date("Y", strtotime("-1 YEAR", strtotime(date("Y-m-d"))))."-12-31";
            $maininscl=0;
            $sex=0;
            $inscl="(NOT ISNULL(INSCL) OR ISNULL(INSCL))";
            $gender="p.SEX IN ('1','2')";
            $agestart=0;
            $agestop=150;
        }  

        $sql="SELECT * FROM 
                (
                SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME
                ,t0.TARGET
                ,t1.HT
                ,t2.HTDM
                ,FORMAT((t1.HT/t0.TARGET*100),2) AS HTRATE 
                FROM   chospital h
                LEFT JOIN 
                (
                SELECT p.HOSPCODE,count(*) TARGET
                FROM  $persontable p

                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                GROUP BY p.HOSPCODE

                ) t0
                ON h.hoscode=t0.HOSPCODE
                LEFT JOIN 
                (
                SELECT p.HOSPCODE,count(*) HT
                FROM  $persontable p
                INNER JOIN me_chronicregist c
                ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                AND ".$inscl."
                AND c.HT_TYPEDISCH='03'
                GROUP BY p.HOSPCODE
                ) t1
                ON h.hoscode=t1.HOSPCODE 
                LEFT JOIN 
                (
                SELECT p.HOSPCODE,count(*) HTDM
                FROM  $persontable p
                INNER JOIN me_chronicregist c
                ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                AND ".$inscl."
                AND c.HT_TYPEDISCH='03' AND c.DM_TYPEDISCH='03'
                GROUP BY p.HOSPCODE
                ) as	 t2 
                ON h.hoscode=t2.HOSPCODE 
                WHERE h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                ) as a
                UNION 
                SELECT * FROM (
                SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME
                ,t0.TARGET
                ,t1.HT
                ,t2.HTDM
                ,FORMAT((t1.HT/t0.TARGET*100),2) AS HTRATE 
                FROM
                (
                SELECT p.HOSPCODE,count(*) TARGET
                FROM  $persontable p
                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                ) t0
                LEFT JOIN    
                (
                SELECT p.HOSPCODE,count(*) HT
                FROM  $persontable p
                INNER JOIN me_chronicregist c
                ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                AND ".$inscl."
                AND c.HT_TYPEDISCH='03'
                ) t1
                ON t0.HOSPCODE=t1.HOSPCODE 
                LEFT JOIN 
                (
                SELECT p.HOSPCODE,count(*) HTDM
                FROM  $persontable p
                INNER JOIN me_chronicregist c
                ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                WHERE  p.TYPEAREA in ('1','3')
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                AND ".$inscl."
                AND c.HT_TYPEDISCH='03' AND c.DM_TYPEDISCH='03'
                ) t2 
                ON t1.HOSPCODE=t2.HOSPCODE 
                ) as b";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
           // 'key' => 'HOSPCODE',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'sql'=>$sql,
            'persontable'=>$persontable,
            'year_id'=>$year_id,
            'maininscl'=>$maininscl,
            'sex'=>$sex,
            'agestart'=> $agestart,
            'agestop'=> $agestop,
            'enddate'=>$enddate,
            
        ]);
        

        
    }
    
    // บัญชีรายชื่อ
    
        public function actionList() {
        
       // $model = new ChronicSearchForm;
        
     //    \yii\helpers\VarDumper::dump($model,10,true);
        
        if (!empty(Yii::$app->request->get())) {
           // $params=Yii::$app->request->queryParams;
         //   \yii\helpers\VarDumper::dump($params,10,true);
            $hospcode=Yii::$app->request->get('hospcode');
            $year_id=Yii::$app->request->get('year_id');
            $maininscl=Yii::$app->request->get('maininscl');
            $sex=Yii::$app->request->get('sex');
            $agestart=Yii::$app->request->get('agestart');
            $agestop=Yii::$app->request->get('agestop');
            $enddate=Yii::$app->request->get('enddate');
            
            if($year_id==2556){
                $enddate="2012-12-31";
                $persontable='person_2556';
            }elseif($year_id==2557){
                $enddate="2013-12-31";
                $persontable='person_2557';
            }elseif($year_id==2558){
                $enddate="2014-12-31";
                $persontable='person_2558';
            }elseif($year_id==2559){
                $enddate="2015-12-31";
                $persontable='person';
            }else{
                 $persontable='person';
            }
           
            if( $maininscl==0){
                 $inscl="(NOT ISNULL(INSCL) OR ISNULL(INSCL))";
            }elseif ($maininscl==1) {
                $inscl="(INSCL in ('UCS','WEL'))";
            }else{
                 $inscl="(INSCL NOT in ('UCS','WEL'))";
            }          
           
            if($sex==1){
               $gender="p.SEX IN ('1')";
            }elseif ($sex==2) {
                $gender="p.SEX IN ('2')";
            }else{
                $gender="p.SEX IN ('1','2')";
            }  
            
        }else {
            return false; 
        }
        
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {

        $sql="SELECT c.HN_HMAIN,c.CID,c.`NAME`,c.LNAME,c.BIRTH,c.SEX,c.HOUSE,c.VILLAGE_ID,c.HT_DATE_DX,c.DM_DATE_DX
                FROM $persontable p 
                INNER JOIN me_chronicregist c 
                ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                WHERE p.TYPEAREA in ('1','3') 
                AND p.DISCHARGE='9'
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                AND  ".$gender."
                AND ".$inscl."
                AND c.HT_TYPEDISCH='03'
                AND p.HOSPCODE='".$hospcode."'                
                ORDER BY c.AREA_ID,c.HOSPCODE ";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
           // 'key' => 'HOSPCODE',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        return $this->render('list', [
             'dataProvider' => $dataProvider,
//            'model' => $model,
            'sql'=>$sql,
            'year_id'=>$year_id,
            'maininscl'=>$maininscl,
            'sex'=>$sex,
            'agestart'=> $agestart,
            'agestop'=> $agestop,
            
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