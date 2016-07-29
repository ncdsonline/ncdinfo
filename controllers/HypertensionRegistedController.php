<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\ChronicSearchForm;


class HypertensionRegistedController extends \yii\web\Controller  {
    
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
                      'actions'=>['index','all','list'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }

    public function actionIndex() {

        $model = new ChronicSearchForm;
        
        if ($model->load(Yii::$app->request->get())) {
            $params=Yii::$app->request->queryParams;

            //$disease=$params['ChronicSearchForm']['disease'];
            $year_id=$params['ChronicSearchForm']['year_id'];
            $agestart=$params['ChronicSearchForm']['agestart'];
            $agestop=$params['ChronicSearchForm']['agestop'];
           
           
            
            if($year_id==2016){
                $year_id=2016;
                $enddate="2016-12-31";
            }elseif($year_id==2015){
                $enddate="2015-12-31"; 
             }elseif($year_id==2014){
                $enddate="2014-12-31";
            }elseif($year_id==2013){
                $enddate="2013-12-31";
            }elseif($year_id==2012){
                $enddate="2012-12-31";
            }elseif($year_id==2011){
                $enddate="2011-12-31";
            }elseif($year_id==2010){
                  $year_id=2010;
                $enddate="2010-12-31";
            }elseif($year_id==2009){
                $enddate="2009-12-31"; 
            }elseif($year_id==2008){
                $enddate="2008-12-31"; 
            }elseif($year_id==2007){
                $enddate="2007-12-31"; 
            }else{
               $year_id=date("Y");
            }  
       
//echo $year_id.'<br>'.$enddate.'<br>'.$agestart.'<br>'.$agestop.'<br>';
//exit();
               
        }else{                      
// default value
             $year_id=date("Y");
              //   $enddate=(date("Y", strtotime("-1 YEAR", strtotime(date("Y-m-d"))))+1)."-12-31";
                
            $enddate=date("Y")."-12-31";
            $agestart=0;
            $agestop=150;
        }
            $sql="SELECT * FROM 
                        (
                        SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME
                        ,t0.TOTAL,t0.ONTREATMENT,t0.DISCHARGED 
                        FROM chospital h 
                        LEFT JOIN 
                        ( 
                        SELECT c.HOSPCODE,c.HOSPNAME 
                        ,count(*) TOTAL 
                        ,sum(if(HT_TYPEDISCH='03',1,0)) AS ONTREATMENT 
                        ,sum(if(HT_TYPEDISCH<>'03',1,0)) AS DISCHARGED 
                        FROM me_chronicregist c 
                        WHERE NOT ISNULL(c.HT_DX) 
                        AND YEAR(c.HT_DATE_DX)='".$year_id."' 
                        AND TIMESTAMPDIFF(YEAR,c.BIRTH,'".$enddate."') BETWEEN '".$agestart."' AND '".$agestop."' 
                        GROUP BY c.HOSPCODE 
                        ) as t0 
                        ON h.hoscode=t0.HOSPCODE 
                        WHERE h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832' 
                        ORDER BY h.subdistcode,h.hoscode,h.mu 
                        ) as t1
                        UNION 
                        (

                        SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME 
                        ,count(*) TOTAL 
                        ,sum(if(HT_TYPEDISCH='03',1,0)) AS ONTREATMENT 
                        ,sum(if(HT_TYPEDISCH<>'03',1,0)) AS DISCHARGED 
                        FROM me_chronicregist c 
                        WHERE NOT ISNULL(c.HT_DX) 
                        AND YEAR(c.HT_DATE_DX)='".$year_id."' 
                        AND TIMESTAMPDIFF(YEAR,c.BIRTH,'".$enddate."') BETWEEN '".$agestart."' AND '".$agestop."' 
                        ) ;";

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
//            'persontable'=>$persontable,
            'year_id'=>$year_id,
//            'maininscl'=>$maininscl,
//            'sex'=>$sex,
            'agestart'=> $agestart,
            'agestop'=> $agestop,
            'enddate'=>$enddate,            
        ]);
       
    }
    
    // บัญชีรายชื่อ
        public function actionAll() {

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
        $sql="SELECT HOSPCODE,HOSPNAME
                ,CID,`NAME`,LNAME,BIRTH,HOUSE,VILLAGE_ID,HT_DATE_DX,DM_DATE_DX,HT_TYPEDISCH
                FROM me_chronicregist 
                WHERE HOSPCODE='".$hospcode."'
                AND NOT ISNULL(HT_DX)
                ORDER BY VILLAGE_ID,HOUSE ";
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
        
        return $this->render('all', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
//            'year_id'=>$year_id,
//            'maininscl'=>$maininscl,
//            'sex'=>$sex,
//            'agestart'=> $agestart,
//            'agestop'=> $agestop,
//            
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