<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
// use  kartik\widgets\AlertBlock;
use kartik\alert\AlertBlock;
use yii\bootstrap\Alert;
//use kartik\widgets\AlertBlock;

$this->title = 'Lab Test Booking';
$this->params['breadcrumbs'][] = $this->title;
?>

 <?php
if(Yii::$app->session->getFlash('success')){
echo '<div class="alert alert-success" role="alert">...</div>';

}
?>

<div class="box box-success box-solid">
        <div class="box-header">
            <h4>บัญชีรายชื่อผู้ป่วยโรคเบาหวาน-ความดันโลหิตสูง</h4>
        </div>   


<div class="box-body">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'id'=>'grid-register',
        'dataProvider' => $dataProvider,
         'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
       // 'filterModel' => $searchModel,
        'columns' => [
            
            ['class' => 'yii\grid\SerialColumn'],
             [
                    'class' => 'yii\grid\CheckboxColumn',
                       //'checkboxOptions' => function ($model, $key, $index, $column) {
                        //    return ['data-pid' => $model->CID];
                       // }
            ],
            //'ID',
            'HN_HMAIN',
           // 'HOSPCODE',
           // 'HOSPNAME',
          //  'PID',
             'CID',
             'NAME',
             'LNAME',
            // 'BIRTH',
            'AGE',
             'HOUSE',
                    'VILLAGE_ID',
//            'TYPEAREA',
//            'DISCHARGE',
             'DM_DX',
             'HT_DX',

         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
<?php

$this->registerJs('
  jQuery("#btn-send").click(function(){
    var keys = $("#grid-register").yiiGridView("getSelectedRows");
    var dateexam = $("#mechronicregistsearch-dateexam").val();
//    alert(keys+ "dateexam=" + dateexam);
    console.log(keys);
    if(keys.length>0){
      jQuery.post("'.Url::to(['save-lab']).'",{ids:keys.join(),dateexam:dateexam},function(){
          
           $("input:checkbox").removeAttr("checked"); 
      });
    }
  });
');
 ?>
    

