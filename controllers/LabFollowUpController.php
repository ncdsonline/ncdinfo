<?php

namespace app\controllers;

use Yii;
use app\models\Labfu;
use app\models\LabfuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LabFollowUpController implements the CRUD actions for Labfu model.
 */
class LabFollowUpController extends Controller
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

    /**
     * Lists all Labfu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LabfuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Labfu model.
     * @param string $HOSPCODE
     * @param string $PID
     * @param string $SEQ
     * @param string $LABTEST
     * @return mixed
     */
    public function actionView($HOSPCODE, $PID, $SEQ, $LABTEST)
    {
        return $this->render('view', [
            'model' => $this->findModel($HOSPCODE, $PID, $SEQ, $LABTEST),
        ]);
    }

    /**
     * Creates a new Labfu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Labfu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'HOSPCODE' => $model->HOSPCODE, 'PID' => $model->PID, 'SEQ' => $model->SEQ, 'LABTEST' => $model->LABTEST]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Labfu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $HOSPCODE
     * @param string $PID
     * @param string $SEQ
     * @param string $LABTEST
     * @return mixed
     */
    public function actionUpdate($HOSPCODE, $PID, $SEQ, $LABTEST)
    {
        $model = $this->findModel($HOSPCODE, $PID, $SEQ, $LABTEST);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'HOSPCODE' => $model->HOSPCODE, 'PID' => $model->PID, 'SEQ' => $model->SEQ, 'LABTEST' => $model->LABTEST]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Labfu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $HOSPCODE
     * @param string $PID
     * @param string $SEQ
     * @param string $LABTEST
     * @return mixed
     */
    public function actionDelete($HOSPCODE, $PID, $SEQ, $LABTEST)
    {
        $this->findModel($HOSPCODE, $PID, $SEQ, $LABTEST)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Labfu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $HOSPCODE
     * @param string $PID
     * @param string $SEQ
     * @param string $LABTEST
     * @return Labfu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($HOSPCODE, $PID, $SEQ, $LABTEST)
    {
        if (($model = Labfu::findOne(['HOSPCODE' => $HOSPCODE, 'PID' => $PID, 'SEQ' => $SEQ, 'LABTEST' => $LABTEST])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
