<?php
namespace app\controllers;
use app\models\PersonForm;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\ChronicSearchForm;
use yii\filters\AccessControl;
use mPDF;

class DmController extends \yii\web\Controller  {
    
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
                      'actions'=>['index','list','letter'],
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
            }else{
              echo 'error';
                
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
            $enddate=date('Y-m-d');
            $maininscl=0;
            $sex=0;
            $inscl="(NOT ISNULL(INSCL) OR ISNULL(INSCL))";
            $gender="p.SEX IN ('1','2')";
            $agestart=0;
            $agestop=150;
        }  

        $sql="SELECT * FROM 
(
		SELECT  h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME
		,t0.TARGET 
		,t1.DM 
		,FORMAT((t1.DM/t0.TARGET*100),2) AS RATE
		FROM chospital h 
		LEFT JOIN
		(
                    SELECT p.HOSPCODE,count(*) TARGET
                      FROM  $persontable p
                    WHERE p.TYPEAREA in ('1','3')
                    AND p.DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                     AND  ".$gender."
                    GROUP BY p.HOSPCODE
		) as t0
		ON h.hoscode=t0.HOSPCODE			
		LEFT JOIN 
		(
                    SELECT p.HOSPCODE,count(*) AS DM
                    FROM  $persontable p
                    INNER JOIN me_chronicregist c
                    ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                    WHERE  p.TYPEAREA in ('1','3')
                    AND p.DISCHARGE='9'
                    AND NOT ISNULL(c.DM_DX)
                    AND c.DM_DATE_DX <= '". $enddate."'
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                    AND  ".$gender."
                    AND ".$inscl."
                    GROUP BY p.HOSPCODE
		) as t1 
		ON h.hoscode=t1.HOSPCODE			
		WHERE h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
		GROUP BY h.hoscode 
		ORDER BY h.subdistcode,h.hoscode 
) as a 
UNION 
(
		SELECT  '' AS HOSPCODE,'TOTAL' AS HOSPNAME
		,t0.TARGET 
		,t1.DM 
		,FORMAT((t1.DM/t0.TARGET*100),2) AS RATE
		FROM 
		(
                    SELECT p.HOSPCODE,count(*) TARGET
                    FROM  $persontable p
                    WHERE p.TYPEAREA in ('1','3')
                    AND p.DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                    AND  ".$gender."
                 
		) as t0
		LEFT JOIN 
		(
                    SELECT p.HOSPCODE,count(*) AS DM
                    FROM  $persontable p
                    INNER JOIN me_chronicregist c
                    ON p.HOSPCODE=c.HOSPCODE AND p.PID=c.PID 
                    WHERE  p.TYPEAREA in ('1','3')
                    AND p.DISCHARGE='9'
                    AND NOT ISNULL(c.DM_DX)
                    AND c.DM_DATE_DX <= '". $enddate."'
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
                    AND  ".$gender."
                    AND ".$inscl."
		) as t1 
		ON t0.HOSPCODE=t1.HOSPCODE); ";
        echo $sql;
        exit();
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
            
//            echo  $enddate;
//            exit();
//            
            if($enddate=='2015-12-31'){
               // $enddate='2012-12-31';
                $persontable='person_2559';
            }elseif($enddate=='2014-12-31'){
              //  $enddate='2014-12-31';
                $persontable='person_2558';
            }elseif($enddate==date('Y-m-d')){
                $persontable='person';
            }else{
                $enddate=Yii::$app->request->get('enddate');
                 $persontable='person';
            }
           
            if( $maininscl==0){
                 $inscl="(NOT ISNULL(c.INSCL) OR ISNULL(c.INSCL))";
            }elseif ($maininscl==1) {
                $inscl="(c.INSCL in ('UCS','WEL'))";
            }else{
                 $inscl="(c.INSCL NOT in ('UCS','WEL'))";
            }          
           
            if($sex==1){
               $gender="c.SEX IN ('1')";
            }elseif ($sex==2) {
                $gender="c.SEX IN ('2')";
            }else{
                $gender="c.SEX IN ('1','2')";
            }  
            
        }else {
            
                        // default value
//            $persontable='person';
//            $year_id=date("Y")+543;
//            $enddate=date('Y-m-d');
//            $maininscl=0;
//            $sex=0;
//            $inscl="(NOT ISNULL(INSCL) OR ISNULL(INSCL))";
//            $gender="p.SEX IN ('1','2')";
//            $agestart=0;
//            $agestop=150;
//            
//            
            
            
            
        }
        
                // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT c.HN_HMAIN,c.CID,c.`NAME`,c.LNAME,c.BIRTH,c.AGE,c.SEX,c.HOUSE,c.VILLAGE_ID,c.DM_DATE_DX,c.HT_DATE_DX
            FROM  me_chronicregist c 
            WHERE c.TYPEAREA in ('1','3') 
            AND c.DISCHARGE='9'
            AND NOT ISNULL(c.DM_DX)
            AND c.DM_DATE_DX <= '". $enddate."'
            AND TIMESTAMPDIFF(YEAR,c.BIRTH,'".$enddate."') BETWEEN '". $agestart."' AND '".$agestop."'
            AND  ".$gender."
          
            AND c.HOSPCODE='".$hospcode."'            
            ORDER BY c.AREA_ID,c.HOSPCODE ";
//        
//        echo $sql;
//        exit();
        
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
            'sql'=>$sql,
            'year_id'=>$year_id,
            'maininscl'=>$maininscl,
            'sex'=>$sex,
            'agestart'=> $agestart,
            'agestop'=> $agestop,
            'enddate'=> $enddate,
            
        ]);
        
                }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['index']);
        }else{
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        } 
        
    }
    
    
    
    public function actionLetter(){
    
      $sql = "SELECT c.HN_HMAIN,c.CID,c.`NAME`,c.LNAME,c.BIRTH,c.AGE,c.SEX,c.HOUSE,c.VILLAGE_ID,c.DM_DATE_DX,c.HT_DATE_DX
            FROM  me_chronicregist c 
            WHERE c.TYPEAREA in ('1','3') 
            AND c.DISCHARGE='9'
            AND NOT ISNULL(c.DM_DX)
            AND c.HOSPCODE='".Yii::$app->user->identity->profile->office_id ."'          
            ORDER BY c.AREA_ID,c.HOSPCODE ";

      $command = Yii::$app->db->createCommand($sql);
      //$command->bindParam(':an', $an, PDO::PARAM_STR);
      $result = $command->queryAll();

      $mpdf = new mPDF('th', array(140, 200), '10'/* fontSize */, 'angsana'/* fontName */, '0'/* margin-l */, '0'/* margin-r */, '0'/* margin-t */, '0'/* margin-b */, ''/* margin-h */, ''/* margin-f */, 'P');
      $mpdf->AddPage('P');
      $mpdf->WriteHTML($this->renderPartial('letter', ['result' => $result]));
      return $mpdf->Output();
      exit;
    }
  
    
    
    
}
     ?>