<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Prevalence Diabetes';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4><?php echo 'ความชุกโรคเบาหวาน'. ' &nbsp; &nbsp;'.'ณ '. ' &nbsp; &nbsp;'.$enddate. ' &nbsp; &nbsp;'.'อายุระหว่าง   :'.$agestart.'-'.$agestop.'  ปี'   
                    ?>
                    <?php   
                        if($sex==0){ echo 'ทุกสิทธิ';}elseif($sex==1){echo 'สิทธิ : UC';}else{echo 'สิทธิ : NON UC';}
                    ?>
                    <?php   
                        if($sex==0){ echo 'ทุกเพศ';}elseif($sex==1){echo 'เพศ :ชาย';}else{echo 'เพศ :หญิง';}
                    ?>
                </h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>

             <H4 style="text-align: center">
                 
                <?php // if($sex==0){ echo 'ทุกเพศ';}elseif($sex==1){echo 'เพศ :ชาย';}else{echo 'เพศ :หญิง';}?>
     
               
                 
            </H4>
           
        </div>

        <div class="row">
            <div class="form-group">
                <?= Html::a('พิมพ์จดหมายเชิญคัดกรองวัณโรค',['letter'],['class'=>'btn btn-primary'])?>
            </div>
        </div>
        <div class="row">
           <?php
                if (isset($dataProvider)){
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                        'responsive' => TRUE,
                       // 'hover' => true,
                        //'containerOptions' => ['style' => 'overflow: auto'],
                        'panel' => [

                            'before' => '', //IMPORTANT
                        ],
                        'beforeHeader' => [
                            [
                                'columns' => [
                                    ['content' => 'บัญชีรายชื่อผู้ป่วยโรคเบาหวาน', 'options' => ['colspan' => 12
                                            , 'class' => 'text-center default']],
                                ],
                            // 'options'=>['class'=>'skip-export'] // remove this row from export
                            ]
                        ],

                        //  'floatHeader' => true,
                        // 'layout'=>"\n{pager}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'HN_HMAIN',
                                'label' => 'HN (รพ.พช.)'
                            ],
                            [
                                'attribute' => 'CID',
                                'label' => 'เลขประจำตัว ปชช.'
                            ],
                            [
                                'attribute' => 'NAME',
                                'label' => 'ชื่อ'
                            ],
                            [
                                'attribute' => 'LNAME',
                                'label' => 'สกุล'
                            ],
                            
//                            [ // รวมคอลัมน์
//                              'label'=>'ชื่อ-นามสกุล',
//                              'format'=>'html',
//                              'value'=>function($model, $key, $index, $column){
//                                return $model->title.$model->firstname.' '.$model->lastname;
//                              }
//                            ],
                            [ // แสดงข้อมูล string
                                'attribute' => 'SEX',
                                 'label' => 'เพศ',
                                'format'=>'html',
                                'value'=>function($model, $key, $index, $column){
                                  return $model['SEX']==1 ? "ชาย":"หญิง";
                                }
                              ],

                            [
                                'attribute' => 'AGE',
                                'label' => 'อายุ'
                            ],
                            [ 
                              'label'=>'ที่อยู่',
                              'format'=>'html',
                              'value'=>function($model, $key, $index, $column){
                                return $model['HOUSE'].' &nbsp;&nbsp;หมู่ที่&nbsp;&nbsp;'.$model['VILLAGE_ID'];
                              }
                            ],
//                            [
//                                'attribute' => 'HOUSE',
//                                'label' => 'บ้านเลขที่'
//                            ],
//                            [
//                                'attribute' => 'VILLAGE_ID',
//                                'label' => 'หมู่บ้าน'
//                            ],
                            [
                                'attribute' => 'DM_DATE_DX',
                                'label' => 'วันที่ Dx.DM'
                            ],
                            [
                                'attribute' => 'HT_DATE_DX',
                                'label' => 'วันที่ Dx.HT'
                            ],                            
                            
                            
                        ]
                    ]);
                }
            ?>     
        </div> <!-- // Gridview  -->
        </div> <!-- // body -->
</div><!-- // container -->
</div>

<?php echo $sql;?>
   
     
