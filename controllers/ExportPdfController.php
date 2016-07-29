<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;

use mPDF;
use app\models\MeVisitlab;
use app\models\MeVisitlabSearch;
use yii\data\ActiveDataProvider;
use app\models\Chospital;

class ExportPdfController extends \yii\web\Controller  {
    public $enableCsrfValidation = false;
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only'=>['list'],
//                'rules' => [
//                    [
//                      //  'actions' => ['login', 'error'], // Define specific actions
//                        'allow' => true, // Has access
//                        'roles' => ['@'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
//                    ],
//                    [
//                        'allow' => false, // Do not have access
//                        'roles'=>['?'], // Guests '?'
//                    ],
//                ],
//            ],
//        ];
//    }

    public function actionIndex() {
        $searchModel = new MeVisitlabSearch();
        // set default
        $searchModel->datestart=date('Y-m-d');
        $searchModel->datestop=date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         
        ]);
        
        
        
    }
    public function actionPdf() {

        $params=Yii::$app->request->queryParams;
        // \yii\helpers\VarDumper::dump($params,10,true);
      
        $datestart=$params[1]['datestart'];
        $datestop=$params[1]['datestop'];
        $filename='H'.Yii::$app->user->identity->profile->office_id.'_bookinglabtest'.date('YmdHi').'.pdf';
        // query 
        $model = MeVisitlab::find()
            ->with('mechronicregist')
            ->where('HOSPCODE = :HOSPCODE',
                [
                    ':HOSPCODE'=>Yii::$app->user->identity->profile->office_id,                 
                ]
            )
            ->andFilterWhere(['>=', 'date(CREATED_AT)',$datestart])
            ->andFilterWhere(['<=', 'date(CREATED_AT)',$datestop])
            ->limit(10)
            ->all();
        $office=Chospital::find()
                ->where('hoscode = :hoscode',
                    [
                        ':hoscode'=>Yii::$app->user->identity->profile->office_id,                 
                    ]
                )
                ->one();
        // $mpdf = new mPDF('tha','A4','0','THSaraban');
        $mpdf = new mPDF('tha', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8);
        $mpdf->WriteHTML($this->renderPartial('template',
                    [
                        'model'=>$model,
                        'office'=>$office,
                      //  'dataProvider'=>$dataProvider,
                    ]
                )
        );
        $mpdf->Output($filename, 'D'); // export filename
        exit;
 }
    
}