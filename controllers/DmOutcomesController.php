<?php
namespace app\controllers;
use Yii;
use mPDF;
// use kartik\mpdf;


class DmOutcomesController extends \yii\web\Controller  {
    
    public $enableCsrfValidation = false;

    public function actionIndex()
        {

         $sql="SELECT * 
                FROM 
                (
                SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME 
                ,count(*) AS TOTAL
                ,sum(if((FLAG_DM=1 AND (A1C_LAST < 7)) 
                                OR (FLAG_DM=2 AND (FPG_LAST BETWEEN 70 AND 130) AND (FPG_BEFORELAST BETWEEN 70 AND 130)) 
                                OR (FLAG_DM=3 AND (FPG_LAST BETWEEN 70 AND 130) AND (DTX_LAST BETWEEN 70 AND 130))
                                OR (FLAG_DM=4 AND (DTX_LAST BETWEEN 70 AND 130) AND (DTX_BEFORELAST BETWEEN 70 AND 130)) 
                                ,1,0)) AS UNDERLINE
                ,FORMAT(((sum(if((FLAG_DM=1 AND (A1C_LAST < 7)) 
                                OR (FLAG_DM=2 AND (FPG_LAST BETWEEN 70 AND 130) AND (FPG_BEFORELAST BETWEEN 70 AND 130)) 
                                OR (FLAG_DM=3 AND (FPG_LAST BETWEEN 70 AND 130) AND (DTX_LAST BETWEEN 70 AND 130))
                                OR (FLAG_DM=4 AND (DTX_LAST BETWEEN 70 AND 130) AND (DTX_BEFORELAST BETWEEN 70 AND 130)) 
                                ,1,0)))/count(*)*100),2) AS RATE
                ,sum(if((FLAG_DM=1 AND (A1C_LAST > 6)) 
                                OR (FLAG_DM<>'1' AND (FPG_LAST > 130 OR DTX_LAST > 130  OR FPG_BEFORELAST > 130 OR DTX_BEFORELAST > 130 ) ) 
                                OR ((FLAG_DM<>'1' AND (FPG_LAST < 70 OR DTX_LAST < 70 OR FPG_BEFORELAST < 70 OR DTX_BEFORELAST < 70 ) )) 
                                OR (ISNULL(FLAG_DM)),1,0)) AS MISSED
                FROM chospital h
                LEFT JOIN me_dm_monthly_outcomes p
                ON h.hoscode=p.HOSPCODE 
                WHERE   h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                AND NOT ISNULL(DM_DX)
                AND p.DISCHARGE='9'
                AND p.YEAR_ID='2016' AND p.MONTH_ID='02'
                GROUP BY HOSPCODE
                ORDER BY h.subdistcode,h.hoscode 
                ) as t
                UNION 
                SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME 
                ,count(*) AS TOTAL
                ,sum(if((FLAG_DM=1 AND (A1C_LAST < 7)) 
                                OR (FLAG_DM=2 AND (FPG_LAST BETWEEN 70 AND 130) AND (FPG_BEFORELAST BETWEEN 70 AND 130)) 
                                OR (FLAG_DM=3 AND (FPG_LAST BETWEEN 70 AND 130) AND (DTX_LAST BETWEEN 70 AND 130))
                                OR (FLAG_DM=4 AND (DTX_LAST BETWEEN 70 AND 130) AND (DTX_BEFORELAST BETWEEN 70 AND 130)) 
                                ,1,0)) AS UNDERLINE
                ,FORMAT(((sum(if((FLAG_DM=1 AND (A1C_LAST < 7)) 
                                OR (FLAG_DM=2 AND (FPG_LAST BETWEEN 70 AND 130) AND (FPG_BEFORELAST BETWEEN 70 AND 130)) 
                                OR (FLAG_DM=3 AND (FPG_LAST BETWEEN 70 AND 130) AND (DTX_LAST BETWEEN 70 AND 130))
                                OR (FLAG_DM=4 AND (DTX_LAST BETWEEN 70 AND 130) AND (DTX_BEFORELAST BETWEEN 70 AND 130)) 
                                ,1,0)))/count(*)*100),2) AS RATE
                ,sum(if((FLAG_DM=1 AND (A1C_LAST > 6)) 
                                OR (FLAG_DM<>'1' AND (FPG_LAST > 130 OR DTX_LAST > 130  OR FPG_BEFORELAST > 130 OR DTX_BEFORELAST > 130 ) ) 
                                OR ((FLAG_DM<>'1' AND (FPG_LAST < 70 OR DTX_LAST < 70 OR FPG_BEFORELAST < 70 OR DTX_BEFORELAST < 70 ) )) 
                                OR (ISNULL(FLAG_DM)),1,0)) AS MISSED
                FROM chospital h
                LEFT JOIN me_dm_monthly_outcomes p
                ON h.hoscode=p.HOSPCODE 
                WHERE   h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                AND NOT ISNULL(DM_DX)
                AND p.DISCHARGE='9'
                AND p.YEAR_ID='2016' AND p.MONTH_ID='02'";
//         echo $sql;
//         exit();
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
        ]);
    }
    
    
     public function actionMissed() {
        if (Yii::$app->request->get()){
        $hospcode = Yii::$app->request->get('hospcode'); 
        }
          if (Yii::$app->user->isGuest){
                  return $this->redirect(['site/login']);
          }
     
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT *

                FROM chospital h
                LEFT JOIN me_dm_monthly_outcomes p
                ON h.hoscode=p.HOSPCODE 
                WHERE   h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                AND NOT ISNULL(DM_DX)
                AND p.DISCHARGE='9'
                AND p.YEAR_ID='2016' AND p.MONTH_ID='04'
AND (

(FLAG_DM=1 AND (A1C_LAST > 6)) 
                                OR (FLAG_DM<>'1' AND (FPG_LAST > 130 OR DTX_LAST > 130  OR FPG_BEFORELAST > 130 OR DTX_BEFORELAST > 130 ) ) 
                                OR ((FLAG_DM<>'1' AND (FPG_LAST < 70 OR DTX_LAST < 70 OR FPG_BEFORELAST < 70 OR DTX_BEFORELAST < 70 ) )) 
                                OR (ISNULL(FLAG_DM))


) 
AND p.HOSPCODE='". $hospcode."'";

    echo $sql;
    exit();
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
        
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['index']);
        }else{
            // return false;
             Yii::$app->user->loginUrl = ['site/sign-in'];
        }   
       
    }
    
    
        
}