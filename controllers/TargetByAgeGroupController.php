<?php

namespace app\controllers;

use Yii;
use app\models\TargetSearchForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use kartik\mpdf\Pdf;
//use yii\helpers\VarDumper;
//use yii\web\NotFoundHttpException;


class TargetByAgeGroupController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        
        $model = new TargetSearchForm;
        
        if ($model->load(Yii::$app->request->get())) {
            $params=Yii::$app->request->queryParams;
            $yearreport=$params['TargetSearchForm']['yearreport'];
            $hospcode=$params['TargetSearchForm']['hospcode'];
            $tbl='target'.($yearreport);
            if($hospcode==0){
                $strwhere ='NOT ISNULL(HOSPCODE)';
            }else{
                $strwhere='HOSPCODE='. $hospcode;
            }
        }  else {
            $yearreport=2559;
            $tbl='target'.$yearreport;
            $strwhere ='NOT ISNULL(HOSPCODE)';
         
        }
           
            $sql="SELECT '0-4' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 0 AND 4) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 0 AND 4) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 0 AND 4),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '5-9' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 5 AND 9) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 5 AND 9) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 5 AND 9),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '10-14' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 10 AND 14) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 10 AND 14) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 10 AND 14),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '15-19' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 15 AND 19) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 15 AND 19) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 15 AND 19),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '20-24' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 20 AND 24) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 20 AND 24) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 20 AND 24),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '25-29' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 25 AND 29) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 25 AND 29) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 25 AND 29),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '30-34' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 30 AND 34) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 30 AND 34) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 30 AND 34),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '35-39' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 35 AND 39) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 35 AND 39) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 35 AND 39),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '40-44' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 40 AND 44) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 40 AND 44) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 40 AND 44),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '45-49' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 45 AND 49) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 45 AND 49) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 45 AND 49),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '50-54' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 50 AND 54) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 50 AND 54) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 50 AND 54),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '55-59' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 55 AND 59) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 55 AND 59) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 55 AND 59),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '60-64' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 60 AND 64) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 60 AND 64) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 60 AND 64),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '65-69' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 65 AND 69) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 65 AND 69) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 65 AND 69),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '70-74' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 70 AND 74) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 70 AND 74) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 70 AND 74),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '75-79' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 75 AND 79) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 75 AND 79) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 75 AND 79),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '80-84' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 80 AND 84) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 80 AND 84) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 80 AND 84),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '85-89' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 85 AND 89) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 85 AND 89) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 85 AND 89),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '90-94' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 90 AND 94) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 90 AND 94) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 90 AND 94),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '95-99' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 95 AND 99) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 95 AND 99) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 95 AND 99),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT '100 -150' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 100 AND 150) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 100 AND 150) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 100 AND 150),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere."
                UNION 
                SELECT 'TOTAL' as AGEGROUP 
                ,SUM(IF((AGE BETWEEN 0 AND 150) AND SEX='1',1,0 )) AS MALE
                ,SUM(IF((AGE BETWEEN 0 AND 150) AND SEX='2',1,0 )) AS FEMALE
                ,SUM(IF((AGE BETWEEN 0 AND 150),1,0 )) AS TOTAL
                FROM ".$tbl."
                WHERE ".$strwhere." ";
//echo $sql;
//exit();
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
            'yearreport'=>$yearreport,
            'sql'=>$sql,
        ]);
        
    }

 }