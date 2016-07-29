<?php
namespace app\controllers;
// use Yii;
// use yii\helpers\ArrayHelper;
class LastbpController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
    public function actionIndex() {
        if ((!isset($_POST['agestart']) & !isset($_POST['$agestop'])) || ($_POST['agestart'] > $_POST['agestop'])) {
            $agestart = 0;
            $agestop = 150;
        } else {
            $agestart = $_POST['agestart'];
            $agestop = $_POST['agestop'];
        }
            
        $sql = "SELECT t1.HOSPCODE,t1.HOSPNAME,t1.N_HT,t1.HT_IN,FORMAT((t1.HT_IN/t1.N_HT*100),2) as PERCENT,t1.NO_FU
                FROM (
                SELECT t.HOSPCODE,t.HOSPNAME
                ,count(*) as N_HT
                ,sum(if(HT_OUTCOMES=1,1,0)) as HT_IN
                ,sum(if(HT_OUTCOMES=2,1,0)) as HT_OUT
                ,sum(if(isnull(HT_OUTCOMES),1,0)) as NO_FU
                FROM 
                (
                SELECT HOSPCODE,HOSPNAME,PID,CID,DATE_BP1,SBP1,DBP1,DATE_BP2,SBP2,DBP2 ,DATEDIFF(DATE_BP1,DATE_BP2) as LENDATE
                ,if((SBP1 < 140 AND DBP1 < 90) AND (SBP2 < 140 AND DBP2 < 90)  ,'1'
                 ,if( (SBP1 > 139 AND DBP1 > 89) AND (SBP2 > 139 AND DBP2 > 89) OR ( SBP1 > 139 ) OR ( SBP2 > 139 ) OR (DBP1 > 89) OR  (DBP2 > 89) ,'2',NULL) 
                ) as HT_OUTCOMES
                FROM tmp_me_ht_followup 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND DISCTYPE_C='03'
                ) as t 
                GROUP BY HOSPCODE
                ) as t1
                UNION 
                SELECT '' as HOSPCODE,'TOTAL' AS HOSPNAME,t1.N_HT,t1.HT_IN,FORMAT((t1.HT_IN/t1.N_HT*100),2) as PERCENT,t1.NO_FU
                FROM (
                SELECT t.HOSPCODE,t.HOSPNAME
                ,count(*) as N_HT
                ,sum(if(HT_OUTCOMES=1,1,0)) as HT_IN
                ,sum(if(HT_OUTCOMES=2,1,0)) as HT_OUT
                ,sum(if(isnull(HT_OUTCOMES),1,0)) as NO_FU
                FROM 
                (
                SELECT HOSPCODE,HOSPNAME,PID,CID,DATE_BP1,SBP1,DBP1,DATE_BP2,SBP2,DBP2 ,DATEDIFF(DATE_BP1,DATE_BP2) as LENDATE
                ,if((SBP1 < 140 AND DBP1 < 90) AND (SBP2 < 140 AND DBP2 < 90)  ,'1'
                 ,if( (SBP1 > 139 AND DBP1 > 89) AND (SBP2 > 139 AND DBP2 > 89) OR ( SBP1 > 139 ) OR ( SBP2 > 139 ) OR (DBP1 > 89) OR  (DBP2 > 89) ,'2',NULL) 
                ) as HT_OUTCOMES
                FROM tmp_me_ht_followup 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND DISCTYPE_C='03'
                ) as t 
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
        return $this->render('index', [

                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'agestart' => $agestart,
                    'agestop' => $agestop
        ]);
    }
}
    
?>