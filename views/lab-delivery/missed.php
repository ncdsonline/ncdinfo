<?php


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
$this->title = 'inaccessible lab';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>รายชื่อผู้ที่ยังไม่ได้ตรวจแล็ปในรอบ 1 ปี</h4>
        </div>   

<div class="box-body">
     <div class=" box-title">
           <?php
           
           // echo 'test';
           
           ?>
        </div>      
<?php
if (isset($dataProvider)){
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
        'responsive' => TRUE,
       // 'hover' => true,
        //'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            //  'heading' => '<b>My View</b>',
            'before' => '', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'รายชื่อผู้ป่วย DM/HT ที่ยังไม่ได้ตรวจแล็ปในรอบ 1 ปี', 'options' => ['colspan' => 12
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

                'attribute' => 'CID',
                'label' => 'เลขประจำตัว ปชช.',

            ],
            [
                'attribute' => 'NAME',
                'label' => 'ชื่อ'
            ],
            [
                'attribute' => 'LNAME',
                'label' => 'สกุล'
            ],
            [
                'attribute' => 'SEX',
                'label' => 'เพศ'
            ],

            [
                'attribute' => 'AGE',
                'label' => 'อายุ(ปี)'
            ],
            [
                'attribute' => 'HOUSE',
                'label' => 'บ้านเลขที่'
            ],
            [
                'attribute' => 'VILLAGE_ID',
                'label' => 'หมู่ที่'
            ],
                       [
                'attribute' => 'DM_DX',
                'label' => 'เบาหวาน'
            ],
                       [
                'attribute' => 'HT_DX',
                'label' => 'ความดันฯ'
            ],


          
        ]
    ]);
}
?>
</div>
</div> 

<?php echo $sql ;?>