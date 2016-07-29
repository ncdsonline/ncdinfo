<?php
namespace app\controllers;
use Yii;
use yii\helpers\ArrayHelper;
class HtprevalenceController extends \yii\web\Controller  {
     public $enableCsrfValidation = false;
        public function actionIndex() {
             if ((!isset($_POST['agestart']) & !isset($_POST['$agestop'])) || ($_POST['agestart'] > $_POST['agestop'])) {
                $agestart = 0;
                $agestop = 150;
            } else {
                $agestart = $_POST['agestart'];
                $agestop = $_POST['agestop'];
         
            }
        $sql = "SELECT t0.HOSPCODE,t0.HOSPNAME,t0.NUM_HT
,t1.NUM_POP,ROUND((t0.NUM_HT/t1.NUM_POP*100),2) as RATE 
                    FROM (
                    SELECT HOSPCODE,HOSPNAME,count(DISTINCT HOSPCODE,PID) as NUM_HT 
                    FROM me_chronics 
                    WHERE NOT ISNULL(HT_DX)
                    AND SUBSTR(HT_TYPEDISCH,1,2)='03'
                    AND TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND	AGE BETWEEN 15 AND 150 
                    GROUP BY HOSPCODE 
                    ) as t0
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(DISTINCT HOSPCODE,PID) as NUM_POP 
                    FROM person  
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,BIRTH,CURDATE()) BETWEEN 15 AND 150 
                    GROUP BY HOSPCODE 
                    ) as t1
                    ON t0.HOSPCODE=t1.HOSPCODE
                    UNION 
                    SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME
                    ,t0.NUM_HT
                    ,t1.NUM_POP,ROUND((t0.NUM_HT/t1.NUM_POP*100),2) as RATE 
                    FROM (
                    SELECT HOSPCODE,HOSPNAME,count(DISTINCT HOSPCODE,PID) as NUM_HT 
                    FROM me_chronics 
                    WHERE NOT ISNULL(HT_DX)
                    AND SUBSTR(HT_TYPEDISCH,1,2)='03'
                    AND TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND	AGE BETWEEN 15 AND 150 
                    ) as t0
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(DISTINCT HOSPCODE,PID) as NUM_POP 
                    FROM person  
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND TIMESTAMPDIFF(YEAR,BIRTH,CURDATE()) BETWEEN 15 AND 150 
                    ) as t1
                    ON t0.HOSPCODE=t1.HOSPCODE;";          
           
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
    
    // ความชุกในหมู่บ้านรับผิดชอบ
     public function actionView($HOSPCODE) {
      
        $HOSPCODE = $_GET['HOSPCODE'];
          if(!Yii::$app->user->isGuest  && Yii::$app->user->identity->profile->office_id==$HOSPCODE ){
        $sql="SELECT t0.HOSPCODE,t0.VILLAGE_ID,t0.MOOBAN
                ,t0.NUM_HT
                ,t1.NUM_POP
                ,FORMAT((t0.NUM_HT/t1.NUM_POP*100),2) AS RATE
                FROM 
                (
                SELECT  me_chronics.HOSPCODE,me_chronics.VILLAGE_ID,me_chronics.MOOBAN
                ,SUM(IF((NOT ISNULL(me_chronics.HT_DX) AND me_chronics.HT_TYPEDISCH='03')  
                ,1,0)) as NUM_HT 
                FROM me_chronics 
                WHERE me_chronics.TYPEAREA in('1','3')
                AND me_chronics.DISCHARGE='9'
                AND me_chronics.HOSPCODE='".$HOSPCODE. " '
                AND me_chronics.AGE BETWEEN 15 AND 150
                GROUP BY  me_chronics.VILLAGE_ID
                ORDER BY me_chronics.VILLAGE_ID
                ) as t0 
                LEFT JOIN 
                (
                SELECT 
                h.HOSPCODE,h.VILLAGE,count(*) NUM_POP
                FROM person p
                INNER JOIN home h
                ON p.HOSPCODE=h.HOSPCODE AND p.HID =h.HID 
                WHERE p.TYPEAREA in('1','3')
                AND p.DISCHARGE='9'
                AND p.HOSPCODE='".$HOSPCODE. " '
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) BETWEEN 15 AND 150
                GROUP BY h.VILLAGE
                ) as t1 
                ON t0.HOSPCODE=t1.HOSPCODE AND t0.VILLAGE_ID=t1.VILLAGE 
                UNION 
                SELECT '' AS HOSPCODE,'' as VILLAGE_ID,'TOTAL' AS MOOBAN 
                ,t0.NUM_HT 
                ,t1.NUM_POP
                ,FORMAT((t0.NUM_HT/t1.NUM_POP*100),2) AS RATE
                FROM 
                (
                SELECT  me_chronics.HOSPCODE,me_chronics.VILLAGE_ID,me_chronics.MOOBAN
                ,SUM(IF((NOT ISNULL(me_chronics.HT_DX) AND me_chronics.HT_TYPEDISCH='03')  
                ,1,0)) as NUM_HT 
                FROM me_chronics 
                WHERE me_chronics.TYPEAREA in('1','3')
                AND me_chronics.DISCHARGE='9'
                AND me_chronics.HOSPCODE='".$HOSPCODE. " '
                AND me_chronics.AGE BETWEEN 15 AND 150
                ) as t0
                LEFT JOIN 
                (
                SELECT 
                h.HOSPCODE,h.VILLAGE,count(*) NUM_POP
                FROM person p
                INNER JOIN home h
                ON p.HOSPCODE=h.HOSPCODE AND p.HID =h.HID 
                WHERE p.TYPEAREA in('1','3')
                AND p.DISCHARGE='9'
                AND p.HOSPCODE='".$HOSPCODE. " '
                AND TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) BETWEEN 15 AND 150
                ) as t1
                on	 t0.HOSPCODE=t1.HOSPCODE ;";
       
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


    // บัญชีรายชื่อผู้ป่วยเบาหวาน 
     public function actionList() {
      
        $HOSPCODE = $_GET['HOSPCODE'];
          if(!Yii::$app->user->isGuest  && Yii::$app->user->identity->profile->office_id==$HOSPCODE ){
        $sql="SELECT p.CID,CONCAT(p.`NAME`,'    ',p.LNAME) as FULLNAME,p.SEX,p.AGE,p.HOUSE,p.VILLAGE_ID,p.MOOBAN
                ,p.HT_DX,SUBSTR(p.HT_DATE_DX,1,10) AS DATE_DIAG
                FROM me_chronics p
                WHERE NOT ISNULL(HT_DX)
                AND SUBSTR(HT_TYPEDISCH,1,2)='03'
                AND TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND p.HOSPCODE='"  .$HOSPCODE. "' AND TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) BETWEEN 15 AND 150
                GROUP BY p.CID
                ORDER BY p.VILLAGE_ID,p.HOUSE ;";    
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
                  
        return $this->render('list', [
           
            'dataProvider' => $dataProvider,
             ]);
     }

     
  
     
}
?>