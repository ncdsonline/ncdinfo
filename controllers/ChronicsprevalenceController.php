<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
class ChronicsprevalenceController extends \yii\web\Controller  {
    
    public $enableCsrfValidation = false;
    
    
        public function behaviors(){
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
                      'roles'=>['?']
                    ],
                    [
                      'allow'=>true,
                      'actions'=>['index','view','list'],
                      'roles'=>['Admin','Member']
                    ]
                  ]
                ]
            ];
    }

    // กลุ่มโรคเรื้อรัง  4 กลุ่มโรค
     public function actionIndex() {
        $sql = "SELECT h.hoscode as HOSPCODE,h.hospnamenew as HOSPNAME
                    ,t1.DM_WITHOUT_HT
                    ,t2.HT_WITHOUT_DM
                    ,t3.DM_WITH_HT
										,t4.OTHER
                    FROM chospital h
                    LEFT JOIN
                    (
										SELECT HOSPCODE
                    ,SUM(IF((NOT ISNULL(DM_DX) ) AND (ISNULL(HT_DX) ) ,1,0)) as DM_WITHOUT_HT
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND DM_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
                    GROUP BY  HOSPCODE
                    ) as t1
                    ON h.hoscode=t1.HOSPCODE
                    LEFT JOIN
                    (
										SELECT HOSPCODE
                    ,SUM(IF((ISNULL(DM_DX) ) AND (NOT ISNULL(HT_DX) ) ,1,0)) as HT_WITHOUT_DM
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND HT_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
                    GROUP BY  HOSPCODE
										) as t2
                    ON h.hoscode=t2.HOSPCODE
                    LEFT JOIN
                    (
										SELECT HOSPCODE
                    ,SUM(IF((NOT ISNULL(DM_DX) ) AND (NOT ISNULL(HT_DX) ) ,1,0)) as DM_WITH_HT
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND DM_TYPEDISCH='03'AND HT_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
										GROUP BY  HOSPCODE
                    ) as t3
                    ON h.hoscode=t3.HOSPCODE
                    LEFT JOIN
                    (
										SELECT HOSPCODE
										,count(DISTINCT CID) AS OTHER 
										FROM me_chronicregist 
										WHERE (ISNULL(DM_DX) AND ISNULL(HT_DX)) 
										AND TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND (
											RENAL_TYPEDISCH='03'  OR  ISCHEMIC_TYPEDISCH='03'  OR STROKE_TYPEDISCH ='03' OR COPD_TYPEDISCH='03' 
											OR  ASTHMA_TYPEDISCH='03' OR CA_BREAST_TYPEDISCH ='03' OR CA_CERVIX_TYPEDISCH='03' OR CA_COLON_TYPEDISCH='03'
										)
										AND AGE BETWEEN 35 AND 150 
										GROUP BY HOSPCODE							
                    ) as t4
                    ON h.hoscode=t4.HOSPCODE
                    WHERE h.provcode='67' AND h.distcode='01'
                    AND h.hostype in ('03','06') 
										AND h.hoscode<>'99832'
                    
UNION 
SELECT '' as HOSPCODE,'Total' as HOSPNAME
                    ,t1.DM_WITHOUT_HT
                    ,t2.HT_WITHOUT_DM
                    ,t3.DM_WITH_HT
										,t4.OTHER
                    FROM 
                    (
										SELECT HOSPCODE
                    ,SUM(IF((NOT ISNULL(DM_DX) ) AND (ISNULL(HT_DX) ) ,1,0)) as DM_WITHOUT_HT
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND DM_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
                    ) as t1
                   
                    LEFT JOIN
                    (
										SELECT HOSPCODE
                    ,SUM(IF((ISNULL(DM_DX) ) AND (NOT ISNULL(HT_DX) ) ,1,0)) as HT_WITHOUT_DM
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND HT_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
										) as t2
                    ON t1.HOSPCODE=t2.HOSPCODE
                    LEFT JOIN
                    (
										SELECT HOSPCODE
                    ,SUM(IF((NOT ISNULL(DM_DX) ) AND (NOT ISNULL(HT_DX) ) ,1,0)) as DM_WITH_HT
                    FROM me_chronicregist
                    WHERE TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND DM_TYPEDISCH='03'AND HT_TYPEDISCH='03'
										AND AGE BETWEEN 35 AND 150 
                    ) as t3
                    ON t1.HOSPCODE=t3.HOSPCODE
                    LEFT JOIN
                    (
										SELECT HOSPCODE
										,count(DISTINCT CID) AS OTHER 
										FROM me_chronicregist 
										WHERE (ISNULL(DM_DX) AND ISNULL(HT_DX)) 
										AND TYPEAREA in('1','3')
                    AND DISCHARGE='9'
										AND (
											RENAL_TYPEDISCH='03'  OR  ISCHEMIC_TYPEDISCH='03'  OR STROKE_TYPEDISCH ='03' OR COPD_TYPEDISCH='03' 
											OR  ASTHMA_TYPEDISCH='03' OR CA_BREAST_TYPEDISCH ='03' OR CA_CERVIX_TYPEDISCH='03' OR CA_COLON_TYPEDISCH='03'
										)
										AND AGE BETWEEN 35 AND 150 	
                    ) as t4
                    ON t1.HOSPCODE=t4.HOSPCODE
                      ;";
        //    }
//        echo $sql;
//        exit();

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

       // print_r($dataProvider);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,

        ]);
    }

// ยอดรายป่วยรายหมู่บ้าน

     public function actionView($HOSPCODE) {

        $HOSPCODE = $_GET['HOSPCODE'];
  //  Yii::$app->user->identity->profile->office_id == $HOSPCODE
        if (!Yii::$app->user->isGuest) {

            $sql = "";

            try {
                $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => array('pageSize' => 50),
            ]);
        } else {
            return $this->goHome();
        }

        return $this->render('view', [
                    'HOSPCODE' => $HOSPCODE,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // บัญชีรายชื่อ
    public function actionList($HOSPCODE,$VILLAGE_ID) {
           $HOSPCODE = $_GET['HOSPCODE'];
           $Village = $_GET['VILLAGE_ID'];
            //  VarDumper::dump($HOSPCODE,10,True);
        if(!empty($HOSPCODE)){



            if(!Yii::$app->user->isGuest  && Yii::$app->user->identity->profile->office_id==$HOSPCODE ){
            $sql="SELECT CID,CONCAT(`NAME`,'    ',LNAME) as FULLNAME,SEX,AGE,HOUSE,VILLAGE_ID,MOOBAN
                    ,HT_DX
                    ,STROKE_DX
                    ,ISCHEMIC_DX
                    ,DM_DX
                    ,COPD_DX
                    ,ASTHMA_DX
                    ,CA_DX
                    ,HOSPCODE
                    FROM me_chronics
                    WHERE
                    TYPEAREA in ('1','3')                 AND DISCHARGE='9'
                    AND
                    (
                    (NOT ISNULL(HT_DX) AND HT_TYPEDISCH='03') OR
                    (NOT ISNULL(STROKE_DX) AND STROKE_TYPEDISCH='03') OR
                    (NOT ISNULL(ISCHEMIC_DX) AND ISCHEMIC_TYPEDISCH='03') OR
                    (NOT ISNULL(DM_DX) AND DM_TYPEDISCH='03') OR
                    (NOT ISNULL(COPD_DX) AND COPD_TYPEDISCH='03') OR
                    (NOT ISNULL(ASTHMA_DX) AND ASTHMA_TYPEDISCH='03') OR
                    (NOT ISNULL(CA_DX) AND CA_TYPEDISCH='03')
                    )
                    AND HOSPCODE='".$HOSPCODE."' AND VILLAGE_ID = '".$Village."'
                       ORDER BY VILLAGE_ID,HOUSE
                    ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => array('pageSize' => 50),
        ]);

                  } else {
                      return $this->goHome();
                  }

        return $this->render('list', [
            'HOSPCODE'=>$HOSPCODE,
            'dataProvider' => $dataProvider,
             ]);
        }
     }
    
    public function actionPdf() {
        $myname='jacky';
        return $this->render('pdf', [
            'myname'=>$myname,
//            'HOSPCODE'=>$HOSPCODE,
//            'dataProvider' => $dataProvider,
        ]);
    }
}
     ?>
