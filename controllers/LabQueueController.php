<?php

namespace app\controllers;

use Yii;
use app\models\LabQueueSearchForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use kartik\mpdf\Pdf;
//use yii\helpers\VarDumper;
//use yii\web\NotFoundHttpException;


class LabQueueController extends Controller
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
        
        $model = new LabQueueSearchForm;
        
        if($model->load(Yii::$app->request->get()) 
        && !empty(Yii::$app->user->identity->profile->office_id)
        ){
            $params=Yii::$app->request->queryParams;
//           // \yii\helpers\VarDumper::dump($params,10,true);
            $datestart=$params['LabQueueSearchForm']['datestart'];
            $datestop=$params['LabQueueSearchForm']['datestop'];
        }else{
            $datestart='2015-09-30'; // today
            $datestop='2016-09-30'; // today
         
        }            
            $sql="SELECT DISTINCT c.HOSPCODE,c.HOSPNAME,c.HN_HMAIN,c.CID,c.`NAME`,c.LNAME,c.HOUSE,c.VILLAGE_ID,c.DM_DX,c.HT_DX
                    ,SUBSTR(l.CREATED_AT,1,10) AS SEND_DATE
                    FROM me_visitlab l
                    INNER JOIN me_chronicregist c
                    ON l.CID=c.CID 
                    HAVING SEND_DATE BETWEEN '".$datestart."' AND '".$datestop."'";
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
            'sql'=>$sql,
            'datestart'=>$datestart,
            'datestop'=>$datestop,
  
        ]);
        
    }

 }
 