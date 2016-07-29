<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;



/* @var $this yii\web\View */
/* @var $searchModel app\models\MeChronicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนโรคเรื้อรัง';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
//if($flash = Yii::$app->session->getFlash('success')){
//    echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => $flash]);
//} 
?>


<div class="me-chronics-index">

<!--    <h1><? = Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


   
     <div class="col-lg-3"> 
            <div class="form-group">
                <?= Html::submitButton( 'ส่งตรวจแล็ป', ['id'=>'btn-send','class' => 'btn btn-success' ]) ?>
                <a href="<?= Url::to('index.php?r=me-visitlab')?>"> <i class="fa fa-upload fa-fw"></i> เรียกดูการจองคิว</a>

            </div>
          
     </div>

    <?= GridView::widget([
        'id'=>'grid-register',
        'dataProvider' => $dataProvider,
        
         'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
       // 'filterModel' => $searchModel,
        'layout'=>"{items}",
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                   //'checkboxOptions' => function ($model, $key, $index, $column) {
                    //    return ['data-pid' => $model->CID];
                   // }
            ],
                    
                    
                    
                    
                    
        //  ['class' => 'yii\grid\SerialColumn'],

           'ID',
            'HN_HMAIN',
           // 'HOSPNAME',
//            'PID',
            'CID',
             'NAME',
             'LNAME',
            // 'BIRTH',
             'AGE',
            // 'SEX',
            // 'TYPEAREA',
            // 'DISCHARGE',
            // 'DDISCHARGE',
             'HOUSE',
             'VILLAGE_ID',
            // 'MOOBAN',
            // 'TAMBON_ID',
            // 'TAMBON',
            // 'AMPUR',
            // 'CHANGWAT',
            // 'DM_DATE_DX',
             'DM_DX',
            // 'DM_TYPEDISCH',
            // 'HT_DATE_DX',
             'HT_DX',
            // 'HT_TYPEDISCH',
            // 'RENAL_DATE_DX',
            // 'RENAL_DX',
            // 'RENAL_TYPEDISCH',
            // 'ISCHEMIC_DATE_DX',
            // 'ISCHEMIC_DX',
            // 'ISCHEMIC_TYPEDISCH',
            // 'STROKE_DATE_DX',
            // 'STROKE_DX',
            // 'STROKE_TYPEDISCH',
            // 'COPD_DATE_DX',
            // 'COPD_DX',
            // 'COPD_TYPEDISCH',
            // 'ASTHMA_DATE_DX',
            // 'ASTHMA_DX',
            // 'ASTHMA_TYPEDISCH',
            // 'CA_DATE_DX',
            // 'CA_DX',
            // 'CA_TYPEDISCH',

         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

$this->registerJs('
  jQuery("#btn-send").click(function(){
    var keys = $("#grid-register").yiiGridView("getSelectedRows");
    console.log(keys);
    if(keys.length>0){
      jQuery.post("'.Url::to(['save-lab']).'",{ids:keys.join()},function(){
           $("input:checkbox").removeAttr("checked"); 
      });
    }
  });
');
 ?>
