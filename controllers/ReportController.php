<?php

namespace app\controllers;
use app\models\PersonForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\Person;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

class ReportController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionProfile($curdate=null,$act=null) {
        
        $person = new PersonForm();
        $ps = null;
        $labs = null;
        $cd = null;
        // เมื่อมีการ request
        if($person->load(Yii::$app->request->post()) || !empty(Yii::$app->session->get('person'))){
            //var_dump($person);
            if(!empty($person->person)){
                $session = Yii::$app->session;
                $session->set('person',$person->person);
            }else{
                $person->person = Yii::$app->session->get('person');
            }
            $ps = Person::findOne(['CID'=>Yii::$app->session->get('person')]);
            $connection = Yii::$app->db;
            //echo $curdate;
            //echo self::getPrev($curdate,Yii::$app->session->get('person'));
            if(!empty($act) && $act=='p' && !empty($curdate)){
                $sql ="SELECT MAX(DATE_SERV) FROM lab WHERE DATE_SERV='".self::getPrev($curdate,Yii::$app->session->get('person'))."' AND CID='".Yii::$app->session->get('person')."'";
            }else if(!empty ($act) && $act=='n' && !empty($curdate)){
                $sql ="SELECT MAX(DATE_SERV) FROM lab WHERE DATE_SERV='".self::getNext($curdate,Yii::$app->session->get('person'))."' AND CID='".Yii::$app->session->get('person')."'";
            }else{
               $sql ="SELECT MAX(DATE_SERV) FROM lab WHERE CID='".Yii::$app->session->get('person')."'";
            }
            //echo $sql;
            $max = $connection->createCommand($sql)->queryScalar();
            $labs = new ActiveDataProvider([
                'query'=>  \app\models\Lab::find()
                    ->where(['CID'=>Yii::$app->session->get('person'),'DATE_SERV'=>$max])->orderBy(['DATE_SERV'=>'DESC']),
                'pagination'=>[
                    'pageSize'=>100,
                ]
            ]);
        }
        
        return $this->render('profile',['person'=>$person,'ps'=>$ps,'labs'=>$labs,'cd'=>$max]);
    }
    public static function getNext($curdate=null,$cid=null){
        $connection = Yii::$app->db;
        $sql = "SELECT DATE_SERV FROM lab WHERE DATE_SERV > '".$curdate."' AND CID='".$cid."' ORDER BY DATE_SERV ASC";
        $data = $connection->createCommand($sql)->queryScalar();
        
        return $data;
    }
    public static function getPrev($curdate=null,$cid=null){
        $connection = Yii::$app->db;
        $sql = "SELECT DATE_SERV FROM lab WHERE DATE_SERV < '".$curdate."' AND CID='".$cid."' ORDER BY DATE_SERV DESC";
        $data = $connection->createCommand($sql)->queryScalar();
        //echo $data;
        //echo $sql;
        return $data;
    }
    public function actionPrint($cid=null,$curdate=null){
        $person = Person::findOne(['CID'=>$cid]);
        $connection = Yii::$app->db;
        $sql = "SELECT * FROM lab WHERE DATE_SERV = '".$curdate."' AND CID='".$cid."'";
        $labs = $connection->createCommand($sql)->queryAll();
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $this->renderPartial('print',['person'=>$person,'labs'=>$labs]),
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'defaultFont'=>'garuda',
            'options' => [
                'title' => 'ทดสอบภาษาไทย',
                'subject' => 'ทดสอบ'
            ],
            'methods' => [
                'SetHeader' => ['หน่วยงาน : ' . date("r")],
                'SetFooter' => ['|หน้า {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
        //return $this->render('print');
    }
    public function actionPerson(){
        $p = Person::find()->all();
        $data = ArrayHelper::map($p, function($p,$defaultValue){
                return $p['HOSPCODE'].$p['PID'];
        },function($p,$defaultValue){
        return $p['FNAME'].' '.$p['LNAME'];});
        $out = [];
        foreach($data as $d=>$v){
            $out[] = ['value'=>$v];
        }
        echo Json::encode($out);
    }

}
