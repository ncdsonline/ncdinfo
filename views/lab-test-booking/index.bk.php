<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MeChronicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title= 'Lab Test Booking';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--  display massage     -->

<?php 
// use kartik\widgets\Alert;
//
//echo Alert::widget([
//    'type' => Alert::TYPE_SUCCESS,
//    'title' => 'Well done!',
//    'icon' => 'glyphicon glyphicon-ok-sign',
//    'body' => 'You successfully read this important alert message.',
//    'showSeparator' => true,
//    'delay' => 2000
//]);
?>




<div class="box box-success box-solid">
        <div class="box-header">
            <h4>บัญชีรายชื่อผู้ป่วยโรคเบาหวาน-ความดันโลหิตสูง</h4>
        </div>   
<!--        <div class="box box-title">
               testtest
        </div>-->

    <div class="box-body">


        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <div class="row">        
            <div class="col-lg-3"> 
                <div class="form-group">
                    <?= Html::submitButton( 'ส่งตรวจแล็ป', ['id'=>'btn-send','class' => 'btn btn-success' ]) ?>
                    <a href="<?= Url::to('index.php?r=lab-test-booking-letter')?>"> <i class="fa fa-file-text"></i> เรียกดูการจองคิว</a>
                </div>  
            </div>
        </div>
        <br>
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
              ['class' => 'yii\grid\SerialColumn'],
                [
                 'attribute'=>'HN_HMAIN',
                    'label'=>'HN (รพ.พช.)'
                ],
               // 'HOSPNAME',
    //            'PID',
                'CID',
                 'NAME',
                 'LNAME',
                 'AGE',
                 'HOUSE',
                 'VILLAGE_ID',
                // 'MOOBAN',
                // 'TAMBON',
                // 'AMPUR',
                // 'CHANGWAT',
                 'DM_DX',
                 'HT_DX',

            ],
        ]); ?>

    </div>
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
    

