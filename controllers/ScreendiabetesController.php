<?php
namespace app\controllers;
use app\models\ScreenSearchForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use mPDF;

class ScreendiabetesController extends \yii\web\Controller  {
    
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
        
        $model = new ScreenSearchForm;
        
        
        if ($model->load(Yii::$app->request->get())) {
            $params=Yii::$app->request->queryParams;
             
            $year_id=$params['ScreenSearchForm']['year_id'];
            $agestart=$params['ScreenSearchForm']['agestart'];
            $agestop=$params['ScreenSearchForm']['agestop'];
           
            if($year_id==2559){
                $tabledata='me_screen_dm2559';
            }elseif($year_id==2558){
               $tabledata='me_screen_dm2558';
            }else{
                echo 'error';
            }
              
        }else{
            // default value
            $tabledata='me_screen_dm2559';
            $year_id=2559;
            $agestart=35;
            $agestop=150;
        }  


        $sql="SELECT t0.HOSPCODE,t0.HOSPNAME
                    ,t0.TARGET
                    ,t1.RESULT
                    ,format((t1.RESULT/t0.TARGET*100),2) AS RATE
                    ,t2.LEVEL1
                    ,t3.LEVEL2 
                    ,t4.LEVEL3
                    ,t5.MISSED
                    FROM 
                    (
                    SELECT HOSPCODE,HOSPNAME,COUNT(*) AS TARGET
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ORDER BY TAMBON_ID,HOSPCODE
                    ) as t0
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if(NOT ISNULL(BSLEVEL),1,0)) AS RESULT
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9'
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ORDER BY TAMBON_ID,HOSPCODE
                    ) as t1
                    ON t0.HOSPCODE=t1.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL < 100),1,0)) AS LEVEL1
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9'
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ORDER BY TAMBON_ID,HOSPCODE
                    ) as t2
                    ON t0.HOSPCODE=t2.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL BETWEEN 100 AND 125),1,0)) AS LEVEL2
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ORDER BY TAMBON_ID,HOSPCODE
                    ) as t3
                    ON t0.HOSPCODE=t3.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL > 125),1,0)) AS LEVEL3
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ORDER BY TAMBON_ID,HOSPCODE
                    ) as t4
                    ON t0.HOSPCODE=t4.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((ISNULL(BSLEVEL)),1,0)) AS MISSED
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    GROUP BY HOSPCODE
                    ) as t5
                    ON t0.HOSPCODE=t5.HOSPCODE


                    UNION 
                    SELECT '' as HOSPCODE,'TOTAL' AS HOSPNAME
                    ,t0.TARGET
                    ,t1.RESULT
                    ,format((t1.RESULT/t0.TARGET*100),2) AS RATE
                    ,t2.LEVEL1
                    ,t3.LEVEL2 
                    ,t4.LEVEL3
                    ,t5.MISSED
                    FROM 
                    (
                    SELECT HOSPCODE,HOSPNAME,COUNT(*) AS TARGET
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                     AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t0
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if(NOT ISNULL(BSLEVEL),1,0)) AS RESULT
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9'
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t1
                    ON t0.HOSPCODE=t1.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL < 100),1,0)) AS LEVEL1
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9'
                    AND ISNULL(s.DM_DATE_DX)
                   AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t2
                    ON t0.HOSPCODE=t2.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL BETWEEN 100 AND 125),1,0)) AS LEVEL2
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t3
                    ON t0.HOSPCODE=t3.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((BSLEVEL > 125),1,0)) AS LEVEL3
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t4
                    ON t0.HOSPCODE=t4.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,HOSPNAME,SUM(if((ISNULL(BSLEVEL)),1,0)) AS MISSED
                    FROM ".$tabledata." s
                    WHERE s.TYPEAREA in ('1','3')
                    AND s.DISCHARGE='9' 
                    AND ISNULL(s.DM_DATE_DX)
                    AND s.AGE BETWEEN '".$agestart."' AND '".$agestop."'
                    ) as t5
                    ON t0.HOSPCODE=t5.HOSPCODE;";
        
   
        
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
            'year_id'=>$year_id,
            'agestart'=> $agestart,
            'agestop'=> $agestop,            
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
            ORDER BY c.TAMBON_ID,c.VILLAGE_ID,c.HOSPCODE ";
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
    
    
    
    public function actionLetter()
    {
      $sql = "SELECT c.HN_HMAIN,c.CID,c.`NAME`,c.LNAME,c.BIRTH,c.AGE,c.SEX,c.HOUSE,c.VILLAGE_ID,c.DM_DATE_DX,c.HT_DATE_DX
            FROM  me_chronicregist c 
            WHERE c.TYPEAREA in ('1','3') 
            AND c.DISCHARGE='9'
            AND NOT ISNULL(c.DM_DX)
            AND c.HOSPCODE='".Yii::$app->user->identity->profile->office_id ."'          
            ORDER BY c.TAMBON_ID,c.VILLAGE_ID,c.HOSPCODE ";

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