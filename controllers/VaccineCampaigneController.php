<?php
namespace app\controllers;
use Yii;
use mPDF;
// use kartik\mpdf;


class VaccineCampaigneController extends \yii\web\Controller  {
    
    public $enableCsrfValidation = false;

    public function actionIndex()
        {

            return $this->render('index', [

            ]);
        }
    public function actionViewdt() {

            $sql="SELECT *
                    FROM (
                    SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME
                    ,t0.TARGET 
                    ,t1.RESULT1
                    ,t2.RESULT2 
                    ,FORMAT(((t1.RESULT1+t2.RESULT2)/t0.TARGET*100),2) AS RATE
                    ,t6.MISSED
                    FROM chospital h
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,COUNT(m.PID) as TARGET
                    FROM me_dtc m 
                    WHERE m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    GROUP BY m.HOSPCODE
                    ) as t0
                    ON h.hoscode=t0.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,COUNT(m.PID) as  RESULT1
                    FROM me_dtc m 
                    WHERE m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND SUBSTR(m.VACCINEPLACE901,1,5)=m.HOSPCODE
                    GROUP BY m.HOSPCODE
                    ) as t1 
                    ON h.hoscode=t1.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,COUNT(m.PID) as  RESULT2
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND SUBSTR(m.VACCINEPLACE901,1,5)<>m.HOSPCODE
                    GROUP BY m.HOSPCODE
                    ) as t2 
                    ON h.hoscode=t2.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,count(*) AS MISSED
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    GROUP BY m.HOSPCODE
                    ) as t6 
                    ON h.hoscode=t6.HOSPCODE
                    WHERE h.provcode='67' AND h.distcode='01' AND hostype in ('03','06') AND h.hoscode<>'99832'
                    ORDER BY h.subdistcode,h.hoscode 
                    ) as a
                    UNION 
                    SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME
                    ,t0.TARGET 
                    ,t1.RESULT1
                    ,t2.RESULT2 
                    ,FORMAT(((t1.RESULT1+t2.RESULT2)/t0.TARGET*100),2) AS RATE
                    ,t6.MISSED
                    FROM (
                    SELECT m.HOSPCODE,COUNT(m.PID) as TARGET
                    FROM me_dtc m 
                    WHERE m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    ) as t0
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,COUNT(m.PID) as  RESULT1
                    FROM me_dtc m 
                    WHERE m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND SUBSTR(m.VACCINEPLACE901,1,5)=m.HOSPCODE
                    ) as t1 
                    ON t0.HOSPCODE=t1.HOSPCODE
                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,COUNT(m.PID) as  RESULT2
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND SUBSTR(m.VACCINEPLACE901,1,5)<>m.HOSPCODE
                    ) as t2 
                    ON t0.HOSPCODE=t2.HOSPCODE

                    LEFT JOIN 
                    (
                    SELECT m.HOSPCODE,count(*) AS MISSED
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    ) as t6 
                    ON t0.HOSPCODE=t6.HOSPCODE;";

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
        
        return $this->render('viewdt', [
            'dataProvider' => $dataProvider,
        
        ]);
       
    }
 
    
    
    
    public function actionViewmr() {

            $sql="SELECT * FROM (
                    SELECT h.hoscode AS HOSPCODE,h.hospnamenew AS HOSPNAME 
                    ,t0.TARGET
                    ,t1.RESULT1
                    ,t2.RESULT2
                    ,FORMAT(((t1.RESULT1+t2.RESULT2)*100/t0.TARGET),2) AS RATE 
                    ,t3.MISSED
                    FROM chospital h
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS TARGET 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3') 
                    AND DISCHARGE='9'
                    AND NATION='099'
                    GROUP BY HOSPCODE
                    ) as t0
                    ON h.hoscode=t0.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS RESULT1 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND HOSPCODE=MRCPLACE 
                    GROUP BY HOSPCODE
                    ) as t1
                    ON h.hoscode=t1.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS RESULT2 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND HOSPCODE<>MRCPLACE 
                    GROUP BY HOSPCODE
                    ) as t2
                    ON h.hoscode=t2.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS MISSED 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND ISNULL(MRC)
                    GROUP BY HOSPCODE
                    ) as t3
                    ON h.hoscode=t3.HOSPCODE 
                    WHERE  h.provcode='67' AND h.distcode='01' AND hostype in ('03','06') AND h.hoscode<>'99832'
                    ORDER BY h.subdistcode,h.hoscode 
                    ) as a
                    UNION 
                    SELECT '' AS HOSPCODE,'TOTAL' AS HOSPNAME 
                    ,t0.TARGET
                    ,t1.RESULT1
                    ,t2.RESULT2
                    ,FORMAT(((t1.RESULT1+t2.RESULT2)*100/t0.TARGET),2) AS RATE 
                    ,t3.MISSED
                    FROM 
                    (
                    SELECT HOSPCODE,count(*) AS TARGET 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3') 
                    AND DISCHARGE='9'
                    AND NATION='099'

                    ) as t0

                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS RESULT1 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND HOSPCODE=MRCPLACE 

                    ) as t1
                    ON t0.HOSPCODE=t1.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS RESULT2 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND HOSPCODE<>MRCPLACE 

                    ) as t2
                    ON t0.HOSPCODE=t2.HOSPCODE 
                    LEFT JOIN 
                    (
                    SELECT HOSPCODE,count(*) AS MISSED 
                    FROM me_mrc 
                    WHERE TYPEAREA in ('1','3')
                    AND DISCHARGE='9'
                    AND NATION='099'
                    AND ISNULL(MRC)
                    ) as t3
                    ON t0.HOSPCODE=t3.HOSPCODE ;";

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
        
        return $this->render('viewmr', [
            'dataProvider' => $dataProvider,
        
        ]);
       
    }
    
    
    
    public function actionMisseddt() {
        if (Yii::$app->request->get()){
        $hospcode = Yii::$app->request->get('hospcode'); 
        }
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql=" SELECT m.HOSPCODE,m.CID,`NAME`,LNAME,TIMESTAMPDIFF(YEAR,m.BIRTH,CURDATE()) AS AGE 
                    ,m.HOUSE,m.VILLAGE
                    ,SUBSTR(m.DATE_SERV20X,1,10) AS LAST_VACIINE
                    ,SUBSTR(m.VACCINEPLACE20X,1,5)  AS LAST_VACIINEPLACE
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    AND m.HOSPCODE='".$hospcode."'";

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
        
        return $this->render('misseddt', [
            'dataProvider' => $dataProvider,
        
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['viewdt']);
        }else{
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        } 
        
        
    
    }
    
    
    
    public function actionMisseddtbyvillage() {
        if (Yii::$app->request->get()){
        $hospcode = Yii::$app->request->get('hospcode'); 
 
        }
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
            echo 'member';
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
        
        return $this->render('misseddtbyvillage', [
            'dataProvider' => $dataProvider,
        
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['viewdt']);
        }else{
            // return false;
                  echo 'not is member';
            exit();
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        } 
        
        
    
    }
    
    
       public function actionItemsmisseddt() {
        if (Yii::$app->request->get()){
        $village = Yii::$app->request->get('village'); 
        $hospcode=Yii::$app->user->identity->profile->office_id;
        }

                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql=" SELECT *
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    AND m.HOSPCODE='".$hospcode."'
                    AND m.VILLAGE='".$village."'";


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
        
        return $this->render('itemsmisseddt', [
            'dataProvider' => $dataProvider,
            'village'=>$village,
        
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['viewdt']);
        }else{
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        } 
        
        
    
    }
    
    
    // MR
    
    public function actionMissedmr() {
        if (Yii::$app->request->get()){
        $hospcode = Yii::$app->request->get('hospcode'); 
        }
                        // admin or member is owner data
        if(Yii::$app->user->can('Admin') || 
                (Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id ==$hospcode) )
        {
        $sql="SELECT *
                FROM me_mrc 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND NATION='099'
                AND ISNULL(MRC)
                AND HOSPCODE='". $hospcode."'
                ORDER BY VILLAGE,HOUSE";

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
        
        return $this->render('missedmr', [
            'dataProvider' => $dataProvider,
        
        ]);
        
        }elseif(Yii::$app->user->can('Member')&& Yii::$app->user->identity->profile->office_id !==$hospcode){
            Yii::$app->session->setFlash('danger', 'คุณไม่มีสิทธ์เข้าถึงข้อมูลของหน่วยบริการอื่น');
            return $this->redirect(['viewmr']);
        }else{
            return false;
            //  Yii::$app->user->loginUrl = ['site/sign-in'];
        } 
        
        
       
    }
    
    public function actionPrintmisseddt(){
        if (Yii::$app->request->get()){
            $village = Yii::$app->request->get('village'); 
            $hospcode=Yii::$app->user->identity->profile->office_id;
        }
        $sql = "SELECT *
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    AND m.HOSPCODE='".$hospcode."'
                    AND m.VILLAGE='".$village."' ";
      
        $command = Yii::$app->db->createCommand($sql);
        //$command->bindParam(':an', $an, PDO::PARAM_STR);
        $result = $command->queryAll();

        $mpdf = new mPDF('th', array(140, 200), '8'/* fontSize */, 'angsana'/* fontName */, '0'/* margin-l */, '0'/* margin-r */, '0'/* margin-t */, '0'/* margin-b */, ''/* margin-h */, ''/* margin-f */, 'P');
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($this->renderPartial('letterdt', ['result' => $result]));
        return $mpdf->Output();
        exit;
    }
    
    public function actionLetterdt(){
        if (Yii::$app->request->get()){
            $village = Yii::$app->request->get('village'); 
            $hospcode=Yii::$app->user->identity->profile->office_id;
        }
        $sql = "SELECT m.HOSPCODE,m.CID,`NAME`,LNAME,TIMESTAMPDIFF(YEAR,m.BIRTH,CURDATE()) AS AGE 
                    ,m.HOUSE,m.VILLAGE
                    ,SUBSTR(m.DATE_SERV20X,1,10) AS LAST_VACIINE
                    ,SUBSTR(m.VACCINEPLACE20X,1,5)  AS LAST_VACIINEPLACE
                    FROM me_dtc m 
                    WHERE  m.TYPEAREA in('1','3')
                    AND m.NATION='099'
                    AND ISNULL(m.CODE901)
                    AND m.HOSPCODE='".$hospcode."'  "
                . "AND m.VILLAGE='".$village."'   ";

      $command = Yii::$app->db->createCommand($sql);
      //$command->bindParam(':an', $an, PDO::PARAM_STR);
      $result = $command->queryAll();

      $mpdf = new mPDF('th', array(140, 200), '8'/* fontSize */, 'angsana'/* fontName */, '0'/* margin-l */, '0'/* margin-r */, '0'/* margin-t */, '0'/* margin-b */, ''/* margin-h */, ''/* margin-f */, 'P');
      $mpdf->AddPage('P');
      $mpdf->WriteHTML($this->renderPartial('letterdt', ['result' => $result]));
      return $mpdf->Output();
      exit;
    }
    
    
    
    
    public function actionLettermr(){
        $hospcode=Yii::$app->user->identity->profile->office_id;
        $sql = "SELECT SEX,`NAME`,LNAME,TIMESTAMPDIFF(MONTH,BIRTH,CURDATE()) AS AGEMONTH,HOUSE,VILLAGE 
                FROM me_mrc 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND NATION='099'
                AND ISNULL(MRC)
                AND HOSPCODE='". $hospcode."'
                ORDER BY VILLAGE,HOUSE LIMIT 20   ";

      $command = Yii::$app->db->createCommand($sql);
      //$command->bindParam(':an', $an, PDO::PARAM_STR);
      $result = $command->queryAll();

      $mpdf = new mPDF('th', array(140, 200), '8'/* fontSize */, 'angsana'/* fontName */, '0'/* margin-l */, '0'/* margin-r */, '0'/* margin-t */, '0'/* margin-b */, ''/* margin-h */, ''/* margin-f */, 'P');
      $mpdf->AddPage('P');
      $mpdf->WriteHTML($this->renderPartial('lettermr', ['result' => $result]));
      return $mpdf->Output();
      exit;
    }
    
    
    
    
    
}