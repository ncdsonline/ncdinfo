<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
class TargetsController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;

    
    
    // population type 1 & 3
     public function actionIndex() {
         
        /*
        $myyear=date("Y");  
        $mymonth = date("m",strtotime($myyear));
        if($mymonth==10 || $mymonth==11 || $mymonth==12 ){
            $CYEAR=($myyear+1);
        }else{
             $CYEAR= $myyear;
        }
        $birthstart=($CYEAR-2).'-10-01'  ;
        $birthstop=($CYEAR-1).'-09-30'  ;
        */
         if(date('m')==10 || date('m')==11 || date('m')==12  ){
             $toyear=(date("Y")+1);
         }  else {
           $toyear=date("Y");
           
         }   
         if ((Yii::$app->request->post('agestart')) !== null && (Yii::$app->request->post('agestop')) !== null ) {
            $agestart = Yii::$app->request->post('agestart');
            $agestop = Yii::$app->request->post('agestop');
        } else {
            $agestart = 0;
            $agestop=150;
        }

        $sql = "SELECT t0.HOSPCODE,t0.HOSPNAME 
                            ,t0.MALE,t0.FEMALE,t0.TOTAL
                            FROM 
                            (
                            SELECT p.HOSPCODE,o.hospnamenew as HOSPNAME
                            ,sum(if(p.SEX='1',1,0)) as MALE
                            ,sum(if(p.SEX='2',1,0)) as FEMALE
                            ,sum(if(p.SEX in ('1','2'),1,0)) as TOTAL
                         
                            FROM person p
                            LEFT JOIN home h
                            ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID 
                            LEFT JOIN chospital  o
                            ON p.HOSPCODE=o.hoscode  
                            WHERE p.TYPEAREA in ('1','3') 
                            AND p.DISCHARGE in ('9','')
                            AND TIMESTAMPDIFF(YEAR,p.BIRTH,CONCAT(($toyear-1),'-10-01')) BETWEEN '". $agestart."' AND '". $agestop."'
                            GROUP BY p.HOSPCODE
                            ORDER BY o.subdistcode,p.HOSPCODE
                            ) as t0
                            UNION 
                            SELECT '' as HOSPCODE,'TOTAL' as HOSPNAME 
                            ,SUM(t0.MALE) AS MALE ,sum(t0.FEMALE) as FEMALE ,sum(t0.TOTAL) as TOTAL
                            FROM 
                            (
                            SELECT p.HOSPCODE,o.hospnamenew as HOSPNAME
                            ,sum(if(p.SEX='1',1,0)) as MALE
                            ,sum(if(p.SEX='2',1,0)) as FEMALE
                            ,sum(if(p.SEX in ('1','2'),1,0)) as TOTAL
                            FROM person p
                            LEFT JOIN home h
                            ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID 
                            LEFT JOIN chospital  o
                            ON p.HOSPCODE=o.hoscode  
                            WHERE p.TYPEAREA in ('1','3') 
                            AND p.DISCHARGE in ('9','')
                            AND TIMESTAMPDIFF(YEAR,p.BIRTH,CONCAT(($toyear-1),'-10-01')) BETWEEN '". $agestart."' AND '". $agestop."'
                            GROUP BY p.HOSPCODE
                            ORDER BY o.subdistcode,p.HOSPCODE
                            ) as t0;";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
           // 'key' => 'HOSPCODE',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize'=>10
            ],
        ]);


        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'agestart' =>$agestart,
                    'agestop'=>$agestop,
                    'toyear'=>$toyear,

        ]);
    }
    
    
    // รายหมู่บ้าน      
    // population type 1 & 3
     public function actionView() {
    
        $HOSPCODE=  Yii::$app->user->identity->profile->office_id;

         if(date('m')==10 || date('m')==11 || date('m')==12  ){
             $toyear=(date("Y")+1);
         }  else {
           $toyear=date("Y");
           
         }   
         if ((Yii::$app->request->post('agestart')) !== null && (Yii::$app->request->post('agestop')) !== null ) {
            $agestart = Yii::$app->request->post('agestart');
            $agestop = Yii::$app->request->post('agestop');
        } else {
            $agestart = 0;
            $agestop=150;
        }

        $sql = "SELECT p.HOSPCODE
                    ,h.VILLAGE
                    ,v.villagename as	 VILLAGENAME
                    ,sum(if(p.SEX='1',1,0)) as MALE
                    ,sum(if(p.SEX='2',1,0)) as FEMALE
                    ,sum(if(p.SEX in ('1','2'),1,0)) as TOTAL
                    FROM person p
                    LEFT JOIN home h
                    ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID 
                    LEFT JOIN cvillagelast v
                    ON CONCAT(h.CHANGWAT,h.AMPUR,h.TAMBON,h.VILLAGE)=v.villagecodefull 
                    LEFT JOIN chospital  o
                    ON p.HOSPCODE=o.hoscode
                    WHERE p.TYPEAREA in ('1','3') 
                    AND p.DISCHARGE in ('9','')
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,CONCAT(($toyear-1),'-10-01')) BETWEEN '". $agestart."' AND '". $agestop."'
                    AND p.HOSPCODE='".$HOSPCODE."'              
                    AND o.provcode='67' AND o.distcode='01' AND o.hostype in ('03','06')
                    GROUP BY v.villagecodefull
                    UNION 
                    SELECT '' AS   HOSPCODE
                    ,'' AS VILLAGE
                    ,'TOTAL' AS VILLAGENAME
                    ,sum(if(p.SEX='1',1,0)) as MALE
                    ,sum(if(p.SEX='2',1,0)) as FEMALE
                    ,sum(if(p.SEX in ('1','2'),1,0)) as TOTAL
                    FROM person p
                    LEFT JOIN home h
                    ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID 
                    LEFT JOIN cvillagelast v
                    ON CONCAT(h.CHANGWAT,h.AMPUR,h.TAMBON,h.VILLAGE)=v.villagecodefull 
                    LEFT JOIN chospital  o
                    ON p.HOSPCODE=o.hoscode
                    WHERE p.TYPEAREA in ('1','3') 
                    AND p.DISCHARGE in ('9','')
                    AND TIMESTAMPDIFF(YEAR,p.BIRTH,CONCAT(($toyear-1),'-10-01')) BETWEEN '". $agestart."' AND '". $agestop."'
                    AND p.HOSPCODE='".$HOSPCODE."'              
                    AND o.provcode='67' AND o.distcode='01' AND o.hostype in ('03','06')";

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


        return $this->render('view', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'agestart' =>$agestart,
                    'agestop'=>$agestop,
                    'toyear'=>$toyear,

        ]);
    }

    // รายชื่อบุคลล      
    // population type 1 & 3
     public function actionItems() {
    
        $HOSPCODE=  Yii::$app->user->identity->profile->office_id;
 // $VILLAGE = Yii::$app->request->post('VILLAGE');
 $VILLAGE = Yii::$app->request->get('VILLAGE');
 
         if(date('m')==10 || date('m')==11 || date('m')==12  ){
             $toyear=(date("Y")+1);
         }  else {
           $toyear=date("Y");
           
         }   
         if ((Yii::$app->request->post('agestart')) !== null && (Yii::$app->request->post('agestop')) !== null ) {
            $agestart = Yii::$app->request->post('agestart');
            $agestop = Yii::$app->request->post('agestop');
        } else {
            $agestart = 0;
            $agestop=150;
        }

        $sql = "SELECT p.HOSPCODE
,h.VILLAGE
,v.villagename as	 VILLAGENAME
,p.`NAME`,p.LNAME,p.BIRTH,p.SEX,TIMESTAMPDIFF(YEAR,p.BIRTH,CONCAT('2016','-10-01')) as AGE
,h.HOUSE
FROM person p
LEFT JOIN home h
ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID 
LEFT JOIN cvillagelast v
ON CONCAT(h.CHANGWAT,h.AMPUR,h.TAMBON,h.VILLAGE)=v.villagecodefull 
LEFT JOIN chospital  o
ON p.HOSPCODE=o.hoscode
WHERE p.TYPEAREA in ('1','3') 
AND p.DISCHARGE in ('9','')
AND p.HOSPCODE='".$HOSPCODE."' 
AND h.VILLAGE='". $VILLAGE ."'
AND o.provcode='67' AND o.distcode='01' AND o.hostype in ('03','06')
HAVING AGE BETWEEN '". $agestart."' AND '". $agestop."'
ORDER BY h.HOUSE ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
           // 'key' => 'HOSPCODE',
            'allModels' => $rawData,
               'pagination' => [
        'pageSize' => 10,
    ],
        ]);


        return $this->render('items', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'agestart' =>$agestart,
                    'agestop'=>$agestop,
                    'toyear'=>$toyear,
 'VILLAGE'=>$VILLAGE,
//            'MOO'=>$MOO,
        ]);
    }

}


?>
