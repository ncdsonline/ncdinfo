<?php
namespace app\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
class DmregistController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['list'],
                'rules' => [
                    [
                      //  'actions' => ['login', 'error'], // Define specific actions
                        'allow' => true, // Has access
                        'roles' => ['@'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
                    ],
//                    [
//                        'allow' => false, // Do not have access
//                        'roles'=>['?'], // Guests '?'
//                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
             if ((!isset($_POST['agestart']) & !isset($_POST['$agestop'])) || ($_POST['agestart'] > $_POST['agestop'])) {
                $agestart = 0;
                $agestop = 150;
            } else {
                $agestart = $_POST['agestart'];
                $agestop = $_POST['agestop'];
            }
            
        $sql = "SELECT t0.HOSPCODE,t0.HNAME,t0.N,t0.POP,FORMAT((t0.N/t0.POP*10000),2)  as RATE 
                        FROM 
                        (
                        SELECT t.HOSPCODE,c.hospnamenew as HNAME,count(*) N,'8000' as POP
                        FROM tmp_me_allchronic  t
                        LEFT JOIN chospital c 
                        ON t.HOSPCODE=c.hoscode 
                        WHERE t.TYPEAREA in ('1','3')
                        AND t.DISCHARGE='9'
                        AND NOT ISNULL(t.DM_DX)
                        AND substr(t.DM_TYPEDISCH,1,2)='03'
                        AND TIMESTAMPDIFF(YEAR,t.BIRTH,CURDATE()) BETWEEN $agestart AND $agestop
                        GROUP BY t.HOSPCODE 
                        ) as t0
                        UNION 
                        SELECT '' as HOSPCODE,'Total' as HNAME,t1.N,t1.POP,FORMAT((t1.N/t1.POP*10000),2)  as RATE 
                        FROM 
                        (
                        SELECT t.HOSPCODE,c.hospnamenew as HNAME,count(*) N,'200000' as POP
                        FROM tmp_me_allchronic  t
                        LEFT JOIN chospital c 
                        ON t.HOSPCODE=c.hoscode 
                        WHERE t.TYPEAREA in ('1','3')
                        AND t.DISCHARGE='9'
                        AND NOT ISNULL(t.DM_DX)
                        AND substr(t.DM_TYPEDISCH,1,2)='03'
                        AND TIMESTAMPDIFF(YEAR,t.BIRTH,CURDATE()) BETWEEN $agestart AND $agestop
                        ) as t1";
           
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
       'agestart' => $agestart,
       'agestop' => $agestop
        ]);
    }
    
// ทะเบียนผู้ป่วยเบาหวาน
     public function actionView($HOSPCODE) {
      
        if(!empty($HOSPCODE)){
            $HOSPCODE = $_GET['HOSPCODE'];
            if(!Yii::$app->user->isGuest  && Yii::$app->user->identity->profile->office_id==$HOSPCODE ){
            $sql="
                        SELECT t.CID,t.`NAME`,t.LNAME,t.SEX,TIMESTAMPDIFF(YEAR,t.BIRTH,CURDATE()) as AGE ,t.HOUSE,t.VILLAGE,t.VILLAGENAME
			,SUBSTR(t.DM_DX,1,4) AS DM_DX,SUBSTR(t.DM_DATE_DX,1,10) AS DM_DATE_DX
                        ,f.LAST_HBA1C,f.BS_LAST1
                        FROM tmp_me_allchronic  t
                        LEFT JOIN chospital c 
                        ON t.HOSPCODE=c.hoscode 
                        LEFT JOIN tmp_me_dm_followup f
                        ON t.HOSPCODE=f.HOSPCODE AND t.PID=f.PID 
                        WHERE t.TYPEAREA in ('1','3')
                        AND t.DISCHARGE='9'
                        AND NOT ISNULL(t.DM_DX)
                        AND substr(t.DM_TYPEDISCH,1,2)='03'
                        AND TIMESTAMPDIFF(YEAR,t.BIRTH,CURDATE()) BETWEEN 35 AND 59
                        AND t.HOSPCODE= $HOSPCODE; ";

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