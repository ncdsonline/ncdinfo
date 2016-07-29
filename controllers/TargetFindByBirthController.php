<?php

namespace app\controllers;

use Yii;
use app\models\TargetSearchForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use kartik\mpdf\Pdf;
//use yii\helpers\VarDumper;
//use yii\web\NotFoundHttpException;


class TargetFindByBirthController extends Controller
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
        
        if($model->load(Yii::$app->request->get() )){
            $params=Yii::$app->request->queryParams;
//           // \yii\helpers\VarDumper::dump($params,10,true);
            $datestart=$params['TargetSearchForm']['datestart'];
            $datestop=$params['TargetSearchForm']['datestop'];
            $yearreport=$params['TargetSearchForm']['yearreport'];
             $tbl='target'.$yearreport;
//
        }else{
            $datestart='1866-10-01';
            $datestop='2015-09-30';
            $yearreport=2559;
            $tbl='target'.$yearreport;
        }

             
            $sql="SELECT t.HOSPCODE,c.hospnamenew as HOSPNAME
                            ,sum(if(t.SEX='1',1,0)) as MALE
                            ,sum(if(t.SEX='2',1,0)) as FEMALE
                            ,sum(if(t.SEX in ('1','2'),1,0)) as TOTAL
                            FROM chospital c
                            INNER JOIN  ".$tbl."  t
                            ON c.hoscode=t.HOSPCODE 
                            WHERE t.BIRTH BETWEEN '". $datestart."' AND '". $datestop."' 
                            GROUP BY t.HOSPCODE

                            UNION 
                            SELECT '' as HOSPCODE,'TOTAL' as HOSPNAME
                            ,sum(if(t.SEX='1',1,0)) as MALE
                            ,sum(if(t.SEX='2',1,0)) as FEMALE
                            ,sum(if(t.SEX in ('1','2'),1,0)) as TOTAL
                            FROM chospital c
                            INNER JOIN  ".$tbl."  t
                            ON c.hoscode=t.HOSPCODE 
                           WHERE t.BIRTH BETWEEN '". $datestart."' AND '". $datestop."' ";
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
            'datestart'=>$datestart,
            'datestop'=>$datestop,
            'yearreport'=>$yearreport,
        ]);
        
    }

 }
 