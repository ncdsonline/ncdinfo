
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
// use app\models\Coffice;
// use yii\helpers\ArrayHelper;
// use etsoft\widgets\YearSelectbox;
$this->title = 'Target by age group';
$this->params['breadcrumbs'][] = ['label' => 'ค้นหาจากกลุ่มอายุ'];

?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>ประชากรจากการสำรวจ  จำแนกตามกลุ่มอายุ</h4>
        </div>   

<div class="box-body">
<div class="well">
 <p><H3 style="text-align: center"><?php echo '  ปีงบประมาณ' . $yearreport;?></H3></p>
</div>
<div class="site-signup">
      <div class="row">

        <?php
        $form = ActiveForm::begin([
                    'id' => 'form-search',
                    'method' => 'get',
        ]);
        ?> 
        <div class="col-lg-3"> 
            <?php echo $form->field($model, 'yearreport')->dropDownList([
                '2558' => 'ปีงบประมาณ 2558',
                '2559' => 'ปีงบประมาณ 2559', 
                ],['prompt' => '--เลือกปีงบประมาณ--'])->label(false); 
            ?>
            </div>
        <div class="col-lg-7"> 
            <?php echo $form->field($model, 'hospcode')->dropDownList([
                '0' => 'ทุกแห่ง',
                '10727' => 'รพท.เพชรบูรณ์ ตำบลในเมือง',
                '99832' => 'ศสม.คลองศาลา ตำบลในเมือง',
                '07711' => 'รพ.สต.ตะเบาะ ตำบลตะเบาะ',
                '07712' => 'รพ.สต.บ้านพี้ ตำบลบ้านโตก',
                '07713' => 'รพ.สต.พนานิคม ตำบลบ้านโตก',
                '07714' => 'รพ.สต.สะเดียง ตำบลสะเดียง',
                '07715' => 'รพ.สต.ป่าแดง ตำบลป่าเลา',
                '07716' => 'รพ.สต.บ้านพลำ ตำบลป่าเลา',
                '07717' => 'รพ.สต.นางั่ว ตำบลนางั่ว',
                '07718' => 'รพ.สต.ท่าพล ตำบลท่าพล',
                '07719' => 'รพ.สต.วังซอง ตำบลท่าพล',
                '07720' => 'รพ.สต.ดงมูลเหล็ก  ตำบลดงมูลเหล็ก',
                '07721' => 'รพ.สต.บ้านโคก ตำบลบ้านโคก',
                '07722' => 'รพ.สต.กงกะยาง ตำบลบ้านโคก',
                '07723' => 'รพ.สต.ชอนไพร ตำบลชอนไพร',
                '07724' => 'รพ.สต.นาป่า ตำบลนาป่า',
                '07725' => 'รพ.สต.หนองผักบุ้ง ตำบลนายม',
                '07726' => 'รพ.สต.ถ้ำน้ำบัง ตำบลนายม',
                '07727' => 'รพ.สต.วังชมภู ตำบลวังชมภู',
                '07728' => 'รพ.สต.น้ำร้อน ตำบลน้ำร้อน',
                '07729' => 'รพ.สต.ห้วยสะแก ตำบลห้วยสะแก',
                '07730' => 'รพ.สต.ห้วยใหญ่ ตำบลห้วยใหญ่',
                '07731' => 'รพ.สต.โป่งหว้า ตำบลห้วยใหญ่',
                '07732' => 'รพ.สต.ยางลาด ตำบลระวิง',
                '07733' => 'รพ.สต.ระวิง ตำบลระวิง'
                ],['prompt' => '--เลือกหน่วยบริการ--'])->label(false); ?>
        </div>

        <div class="col-lg-2"> 
            <div class="form-group">
                <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                 <?= Html::a('เริ่มใหม่',['index'],['class'=>'btn btn-danger'])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>


<?php           // \yii\helpers\VarDumper::dump($dataProvider,10,true);
 echo GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'] ,
    'columns' => [
        [
             'attribute'=>'AGEGROUP',
                'label'=>'กลุ่มอายุ(ปี)'
        ],
        [
             'attribute'=>'MALE',
                'label'=>'ชาย'
        ],
        [
             'attribute'=>'FEMALE',
                'label'=>'หญิง'
        ],
        [
             'attribute'=>'TOTAL',
                'label'=>'รวม'
        ],

    ],
 ]) 
?>
<?php // echo $sql.'<br>';?>

</div>
</div>    
    