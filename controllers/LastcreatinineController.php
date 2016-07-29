<?php
namespace app\controllers;
// use Yii;
// use yii\helpers\ArrayHelper;
class LastcreatinineController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
    public function actionIndex() {
        if ((!isset($_POST['agestart']) & !isset($_POST['$agestop'])) || ($_POST['agestart'] > $_POST['agestop'])) {
            $agestart = 0;
            $agestop = 150;
        } else {
            $agestart = $_POST['agestart'];
            $agestop = $_POST['agestop'];
        }
            
        $sql = "SELECT t.HOSPCODE,t.HOSPNAME
                ,t.TOTAL
                ,t.LEVEL1
                ,FORMAT((t.LEVEL1/t.TOTAL*100),2) AS PERCENT 
                ,t.LEVEL2
                ,t.LEVEL3
                ,t.NO_FU
                FROM (
                SELECT HOSPCODE,HOSPNAME
                ,count(*) AS TOTAL
                ,SUM(if( NOT ISNULL(lastlab11) AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0 )) AS N_CR
                ,SUM(IF(LASTLAB11 BETWEEN 0 AND 2 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL1
                ,SUM(IF(LASTLAB11 > 1.5 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL2
                ,SUM(IF(LASTLAB11 > 2 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL3
                ,SUM(IF(( lastlab11='' OR ISNULL(lastlab11)) ,1,0)) AS NO_FU
                FROM tmp_me_ht_followup 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND DISCTYPE_C='03'
                GROUP BY HOSPCODE
                ) as t
UNION 
SELECT '' as HOSPCODE,'รวม' as HOSPNAME
                ,t.TOTAL
                ,t.LEVEL1
                ,FORMAT((t.LEVEL1/t.TOTAL*100),2) AS PERCENT 
                ,t.LEVEL2
                ,t.LEVEL3
                ,t.NO_FU
                FROM (
                SELECT HOSPCODE,HOSPNAME
                ,count(*) AS TOTAL
                ,SUM(if( NOT ISNULL(lastlab11) AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0 )) AS N_CR
                ,SUM(IF(LASTLAB11 BETWEEN 0 AND 2 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL1
                ,SUM(IF(LASTLAB11 > 1.5 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL2
                ,SUM(IF(LASTLAB11 > 2 AND SUBSTR(DATELAB11,1,10) BETWEEN '2014-10-01' AND '2015-09-30',1,0)) AS LEVEL3
                ,SUM(IF(( lastlab11='' OR ISNULL(lastlab11)) ,1,0)) AS NO_FU
                FROM tmp_me_ht_followup 
                WHERE TYPEAREA in ('1','3')
                AND DISCHARGE='9'
                AND DISCTYPE_C='03') as t";
           
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