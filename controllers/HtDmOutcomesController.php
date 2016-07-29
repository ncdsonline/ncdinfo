<?php
namespace app\controllers;
use Yii;
use mPDF;
// use kartik\mpdf;


class HtDmOutcomesController extends \yii\web\Controller  {
    
    public $enableCsrfValidation = false;

    public function actionIndex()
        {

        $sql="SELECT * FROM 
                (
                SELECT h.hoscode AS  HOSPCODE,h.hospnamenew AS HOSPNAME
                ,count(*) AS TOTAL

                ,sum(if(SBP0<140 AND SBP1<140 AND DBP0< 80 AND DBP1 < 80  ,1,0 )) AS RESULT1
                ,FORMAT(((sum(if(SBP0<140 AND SBP1<140 AND DBP0< 80 AND DBP1 < 80  ,1,0 )))/count(*)*100),2) AS RATE
                ,sum(if(SBP0 >139 OR SBP1 >139 OR DBP0> 79 OR DBP1 > 79 ,1,0)) AS RESULT0
                ,sum(if(ISNULL(SBP0) OR ISNULL(SBP1)  OR  ISNULL(DBP0) OR ISNULL(SBP1)  ,1,0 )) AS MISSED
                FROM chospital h
                LEFT JOIN 
                (
                SELECT p.YEAR_ID,p.MONTH_ID
                ,p.HOSPCODE,p.HOSPNAME
                ,p.CID,p.`NAME`,p.LNAME,p.AGE,p.TYPEAREA,p.DISCHARGE 
                ,p.HT_DATE_DX,p.HT_DX,p.HT_DATE_DISCH
                ,f.SBP0,f.SBP1
                ,f.DBP0,f.DBP1   
                FROM me_monthly_service p
                LEFT JOIN me_bp_followup f
                on	 p.CID=f.CID AND p.YEAR_ID=f.YEAR_ID AND p.MONTH_ID=f.MONTH_ID 
                WHERE p.YEAR_ID='2016' AND p.MONTH_ID='02'
                AND p.HT_TYPEDISCH='03'
                AND NOT ISNULL(p.DM_DX) 
                AND SUBSTR(DM_TYPEDISCH,1,2)='03'
                AND p.YEAR_ID='2016' AND p.MONTH_ID='02'
                ) as t0
                ON h.hoscode=t0.HOSPCODE 
                WHERE	 h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832'
                GROUP BY t0.HOSPCODE
                ORDER BY h.subdistcode,h.hoscode 
                ) as t
                UNION 
                SELECT '' AS  HOSPCODE,'TOTAL' AS HOSPNAME
                ,count(*) AS TOTAL
                ,sum(if(SBP0<140 AND SBP1<140 AND DBP0< 80 AND DBP1 < 80  ,1,0 )) AS RESULT1
                ,FORMAT(((sum(if(SBP0<140 AND SBP1<140 AND DBP0< 80 AND DBP1 < 80  ,1,0 )))/count(*)*100),2) AS RATE
                ,sum(if(SBP0 >139 OR SBP1 >139 OR DBP0> 79 OR DBP1 > 79 ,1,0)) AS RESULT0
                ,sum(if(ISNULL(SBP0) OR ISNULL(SBP1)  OR  ISNULL(DBP0) OR ISNULL(SBP1)  ,1,0 )) AS MISSED
                FROM chospital h
                LEFT JOIN 
                (
                SELECT p.YEAR_ID,p.MONTH_ID
                ,p.HOSPCODE,p.HOSPNAME
                ,p.CID,p.`NAME`,p.LNAME,p.AGE,p.TYPEAREA,p.DISCHARGE 
                ,p.HT_DATE_DX,p.HT_DX,p.HT_DATE_DISCH
                ,f.SBP0,f.SBP1
                ,f.DBP0,f.DBP1   
                FROM me_monthly_service p
                LEFT JOIN me_bp_followup f
                on	 p.CID=f.CID AND p.YEAR_ID=f.YEAR_ID AND p.MONTH_ID=f.MONTH_ID 
                WHERE p.YEAR_ID='2016' AND p.MONTH_ID='02'
                AND p.HT_TYPEDISCH='03'
                AND NOT ISNULL(p.DM_DX) 
                AND SUBSTR(DM_TYPEDISCH,1,2)='03'
                AND p.YEAR_ID='2016' AND p.MONTH_ID='02'
                ) as t0
                ON h.hoscode=t0.HOSPCODE 
                WHERE	 h.provcode='67' AND h.distcode='01' AND h.hostype in('03','06') AND h.hoscode<>'99832';";

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
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT p.HN,p.CID,p.`NAME`,p.LNAME,p.SEX,p.BIRTH,p.AGE,p.HOUSE,p.VILLAGE_ID
                    ,f.SBP0,f.SBP1,f.DBP0,f.DBP1 
                                FROM me_monthly_service p
                                LEFT JOIN me_bp_followup f
                                on	 p.CID=f.CID AND p.YEAR_ID=f.YEAR_ID AND p.MONTH_ID=f.MONTH_ID 
                                WHERE p.YEAR_ID='2016' AND p.MONTH_ID='01'
                                AND p.HT_TYPEDISCH='03'
                                AND NOT ISNULL(p.DM_DX) 
                                AND p.YEAR_ID='2016' AND p.MONTH_ID='01'
                    AND 
                    (
                     SBP0 >139 OR SBP1 >139 OR DBP0> 89 OR DBP1 > 89 
                    ) 
                  
                    AND p.HOSPCODE='". $hospcode."'";

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
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        }   
       
    }
    
    
    
     public function actionLostfollowup() {
        if (Yii::$app->request->get()){
        $hospcode = Yii::$app->request->get('hospcode'); 
        }
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT p.HN,p.CID,p.`NAME`,p.LNAME,p.SEX,p.BIRTH,p.AGE,p.HOUSE,p.VILLAGE_ID
                    ,f.SBP0,f.SBP1,f.DBP0,f.DBP1 
                                FROM me_monthly_service p
                                LEFT JOIN me_bp_followup f
                                on	 p.CID=f.CID AND p.YEAR_ID=f.YEAR_ID AND p.MONTH_ID=f.MONTH_ID 
                                WHERE p.YEAR_ID='2016' AND p.MONTH_ID='01'
                                AND p.HT_TYPEDISCH='03'
                                AND NOT ISNULL(p.DM_DX) 
                                AND p.YEAR_ID='2016' AND p.MONTH_ID='01'
                    AND 
                    (
                     ISNULL(SBP0) OR ISNULL(SBP1)  OR  ISNULL(DBP0) OR ISNULL(SBP1)
                    ) 

                    AND p.HOSPCODE='". $hospcode."'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        return $this->render('lostfollowup', [
            'dataProvider' => $dataProvider,
        
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