<?php

namespace app\controllers;

use Yii;
use app\models\MeChronicregist;
use app\models\MeChronicregistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\MeVisitlab;
// use yii\bootstrap\Alert;

/**
 * MeChronicregistController implements the CRUD actions for MeChronicregist model.
 */
class MeChronicregistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'
//                            , 'logout'
//                            , 'signup'
                            ],
                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login', 'signup'],
//                        'roles' => ['?'],
//                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all MeChronicregist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeChronicregistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }
    public function actionSaveLab(){
        if(($ids = Yii::$app->request->post('ids'))){
            $data = explode(',', $ids);
            foreach ($data as $id){
                $c = MeChronicregist::findOne($id);
                $model = new MeVisitlab();
                $model->CID = $c->CID; // find by PK
                $model->CREATED_BY = (string)Yii::$app->user->id;
                $model->HOSPCODE = Yii::$app->user->identity->profile->office_id;
                $model->CREATED_AT = date('Y-m-d H:i:s');
                $model->save();

               // print_r($model->getErrors());
                unset($c);
                unset($model);
            }
            

// แจ้งข้อความ
//echo AlertBlock::widget([
//    'useSessionFlash' => true,
//    'type' => AlertBlock::TYPE_ALERT
//]);
                return $this->redirect(['index', 'ids' => false]);
                
//            Yii::$app->getSession()->setFlash('success', [
//    'type' => 'success',
//    'duration' => 12000,
//    'icon' => 'fa fa-users',
//    'message' => Yii::t(Html::encode('My Message')),
//    'title' => Yii::t('app', Html::encode('My Title')),
//    'positonY' => 'top',
//    'positonX' => 'left'
//]);
//             return $this->redirect(['index', 'ids' => false]);
            
            
            
            
            
        }
    }
    
    
    
    
    /**
     * Displays a single MeChronicregist model.
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
     * Creates a new MeChronicregist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MeChronicregist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MeChronicregist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MeChronicregist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MeChronicregist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeChronicregist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeChronicregist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
