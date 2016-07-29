<?php

namespace app\controllers;

use Yii;
use app\models\MeVisitlab;
use app\models\MeVisitlabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use mPDF;
use app\models\MeChronicregist;
use yii\web\UrlManager;
use app\models\Chospital;
/**
 * MeVisitlabController implements the CRUD actions for MeVisitlab model.
 */
class LabTestBookingLetterController extends Controller
{
    public function behaviors()
    {
        return [
//                'verbs' => [
//                    'class' => VerbFilter::className(),
//                    'actions' => [
//                        'delete' => ['post'],
//                    ],
//                ],
                'access'=>[
                  'class'=>AccessControl::className(),
                  'rules'=>[
                    [
                      'allow'=>true,
                      'actions'=>['index'],
                      'roles'=>['@']
                    ],
                    [
                      'allow'=>true,
                      'actions'=>['index','delete','view','update','pdf','lab-data','update-lab'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }

    /**
     * Lists all MeVisitlab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeVisitlabSearch();
        // set default
        $searchModel->datestart=date('Y-m-d');
        $searchModel->datestop=date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=51;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
              
            
        ]);
    }

    /**
     * Displays a single MeVisitlab model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MeVisitlab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new MeVisitlab();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->ID]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing MeVisitlab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cid=$model->CID;
        
        $person=MeChronicregist::find()
                ->where([ 'CID'=>$cid])
                ->one();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                'id' => $model->ID,
                 'person'=>$person,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                
                'person'=>$person,
            ]);
        }
    }

    /**
     * Deletes an existing MeVisitlab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       
        $this->findModel($id)->delete(); // owner can delete only
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the MeVisitlab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeVisitlab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeVisitlab::find()->where('ID=:id and HOSPCODE = :HOSPCODE',[':id'=>$id,':HOSPCODE'=>Yii::$app->user->identity->profile->office_id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionLabData(){
       // echo Yii::$app->request->get('ID');
        $id = Yii::$app->request->post('ID');
        $model = $this->findModel($id);
        $cid=$model->CID;
        
        $person=MeChronicregist::find()
                ->where([ 'CID'=>$cid])
                ->one();
        
        $arr = [];
        $arr['NAME'] = $person->NAME;
        $arr['LNAME'] = $person->LNAME;
        $arr['AGE'] = $person->AGE;
        $arr['HOUSE'] = $person->HOUSE;
        $arr['HOUSE'] = $person->HOUSE;
        $arr['VILLAGE_ID'] = $person->VILLAGE_ID;
        $arr['MOOBAN'] = $person->MOOBAN;
        $arr['DM_DX'] = $person->DM_DX;
        $arr['HT_DX'] = $person->HT_DX;
        
        $lab = MeVisitlab::find()->where('ID=:id and HOSPCODE = :HOSPCODE',[':id'=>$id,':HOSPCODE'=>Yii::$app->user->identity->profile->office_id])->one();
        
        $arr['BLOOD'] = $lab->BLOOD;
        $arr['URINE'] = $lab->URINE;
        $arr['LABID'] = $lab->ID;
        
        echo json_encode($arr);
        
    }
    
    
    public function actionUpdateLab(){
        $id = Yii::$app->request->post('id');
        $urine = Yii::$app->request->post('urine');
        $blood = Yii::$app->request->post('blood');
        
        $lab = MeVisitlab::find()->where('ID=:id and HOSPCODE = :HOSPCODE',[':id'=>$id,':HOSPCODE'=>Yii::$app->user->identity->profile->office_id])->one();
        $lab->URINE = $urine;
        $lab->BLOOD = $blood;
        $lab->update();
        
        echo true;
    }
    
   public function actionPdf() {

        $params=Yii::$app->request->queryParams;
        // \yii\helpers\VarDumper::dump($params,10,true);
      
        $datestart=$params[1]['datestart'];
        $datestop=$params[1]['datestop'];
        $filename='H'.Yii::$app->user->identity->profile->office_id.'_labtestbooking'.date('YmdHi').'.pdf';
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
