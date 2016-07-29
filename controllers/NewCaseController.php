<?php


namespace app\controllers;

use Yii;
use app\models\ChronicSearchForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
// use kartik\mpdf\Pdf;
//use yii\helpers\VarDumper;
//use yii\web\NotFoundHttpException;


class NewCaseController extends Controller
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
        
        $model = new ChronicSearchForm;
        
     //    \yii\helpers\VarDumper::dump($model,10,true);
        
        if ($model->load(Yii::$app->request->get())) {
            $params=Yii::$app->request->queryParams;
            $year_dx=$params['ChronicSearchForm']['year_dx'];
            //$disease=$params['ChronicSearchForm']['disease'];
            $sex=$params['ChronicSearchForm']['sex'];
            $maininscl=$params['ChronicSearchForm']['maininscl'];
            $agestart=$params['ChronicSearchForm']['agestart'];
            $agestop=$params['ChronicSearchForm']['agestop'];
            
           
            echo 'year  ->'.$year_dx.'<br>';
            
            echo 'gender ->'.$sex.'<br>';
            echo 'Inscl :  ->'.$maininscl.'<br>';
            echo 'start_age :  ->'.$agestart.'<br>';
            echo 'stop_age :   ->'.$agestop.'<br>';
           
           // echo $dx_stop.'<br>';
            exit();
            
        }else{
            
            
        }  
//          
//         
//        }
           
          //   $sql="";

//        try {
//            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
//        } catch (\yii\db\Exception $e) {
//            throw new \yii\web\ConflictHttpException('sql error');
//        }
//        $dataProvider = new \yii\data\ArrayDataProvider([
//           // 'key' => 'HOSPCODE',
//            'allModels' => $rawData,
//            'pagination' => FALSE,
//        ]);

        return $this->render('index', [
//            'dataProvider' => $dataProvider,
            'model' => $model,
//            'yearreport'=>$yearreport,
//            'sql'=>$sql,
        ]);
        
    }

 }