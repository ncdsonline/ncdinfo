<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeVisitlabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Letter';
$this->params['breadcrumbs'][] = ['label' => 'Lab Test Booking', 'url' => ['lab-test-booking/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="box box-success box-solid">
        <div class="box-header">
            <h4>บัญชีรายชื่อผู้ป่วยที่จองคิวตรวจทางห้องปฎิบัติการ</h4>
        </div>   
<!--        <div class="box box-title">
               testtest
        </div>-->

        <div class="box-body">
            <div class="row">
             <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>    
              
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
//                    [
//                        'attribute'=>'CREATED_AT',
//                        'label'=>'วันเวลาที่บันทึกขัอมูล'
//                    ],
                    ['attribute'=>'CREATED_AT','format'=>'html','value'=>function($model, $key, $index, $column){
                       // return Yii::$app->formatter->asDate($model->CREATED_AT,'long'); //short,medium,long,full
                        return Yii::$app->formatter->asDateTime($model->CREATED_AT,'long');
                    }
                    ],
                    //'ID',
                    //'HOSPCODE',
                    [
                        'attribute'=>'mechronicregist.HN_HMAIN',
                        'label'=>'HN'
                    ],
                    
                    'mechronicregist.CID',
                    'mechronicregist.NAME',
                    'mechronicregist.LNAME',
                    'mechronicregist.HOUSE',
                    'mechronicregist.VILLAGE_ID',
                    'mechronicregist.DM_DX',
                    'mechronicregist.HT_DX',
                    [ // แสดงข้อมูล string
                        'attribute' => 'เลือด',
                        'format'=>'raw',
                        'value'=>function($model, $key, $index, $column){
                          return $model->BLOOD==1 ?  "<span style=\"color:green;\">มี</span>":"<span style=\"color:red;\">ไม่มี</span>";
                        }
                    ],        
                    [ // แสดงข้อมูล string
                        'attribute' => 'ปัสสาวะ',
                        'format'=>'raw',
                        'value'=>function($model, $key, $index, $column){
                          return $model->URINE==1 ? "<span style=\"color:green;\">มี</span>":"<span style=\"color:red;\">ไม่มี</span>";
                        }
                    ],

                  //  'CREATED_AT',
                  //  'CREATED_BY',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options'=>['style'=>'width:120px;'],
                        'buttonOptions'=>['class'=>'btn btn-default'],
                        'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {update} {delete} </div>',
                        'buttons'=>[
                            
                            'update' => function ($url, $model, $key) {
                                return '<button type="button" onclick="openModal(\'' . $model->ID . '\',this)" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>';
                            }
                        ]

                    ],
                ],
            ]); ?>
        </div>
</div>


<!-- Modal Show Success -->
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ผลลัพธ์</h4>
      </div>
      <div class="modal-body">
        <p>บันทึกสำเร็จแล้ว</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    var currentObj;
    
    function openModal(ID, obj){
        $.post('<?php echo Url::toRoute(['lab-test-booking-letter/lab-data']) ?>', 'ID=' + ID, function(data){
            var model = JSON.parse(data);
            $("#personNAME").html(model.NAME + ' ' + model.LNAME);
            $("#age").html(model.AGE);
            $("#address").html(model.HOUSE);
            
            var dm = (model.DM_DX !== null ? model.DM_DX : '');
            var ht = (model.HT_DX !== null ? model.HT_DX : '');
            
            if($.isEmptyObject(dm))
                $("#disease").html(ht);
            else if($.isEmptyObject(ht))
                $("#disease").html(dm);
            else
                $("#disease").html(dm + ", " + ht);
        
        
            $("input[name=blood]").removeAttr('checked');
            $("input[name=urine]").removeAttr('checked');
            
            $("#blood"+model.BLOOD)[0].checked = true;
            $("#urine"+model.URINE)[0].checked = true;
            
            
            
            $("#labId").val(model.LABID);
            
            $("#modalLab").modal('show');
            
            currentObj = obj;
        })
    }
    
    function updateLab(){
        $.post('<?php echo Url::toRoute(['lab-test-booking-letter/update-lab']) ?>', $("#formLab").serialize(), function(data){
            if(data == true){
                $("#modalLab").modal('hide');
                var tr = $(currentObj).parent().parent().parent();
                var bloodTd = $(tr).find("td:eq(10)");
                var urineTd = $(tr).find("td:eq(11)");
                
                var have = '<span style="color:green;">มี</span>';
                var notHave = '<span style="color:red;">ไม่มี</span>';
                
                var bVal = $("input[name=blood]:checked").val();
                
                if(bVal == '1')
                    $(bloodTd).html(have);
                else if(bVal == '0')
                    $(bloodTd).html(notHave);
                
                var uVal = $("input[name=urine]:checked").val();
                if(uVal == '1')
                    $(urineTd).html(have);
                else if(uVal == '0')
                    $(urineTd).html(notHave);
                
                $("#modalAlert").modal('show');
            }
        });
        
    }
</script>

<div id="modalLab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-danger">
            <div class="panel-heading">
                    <h4>แก้ไขข้อมูลสิ่งส่งตรวจของผู้ป่วย</h4>
            </div>  
            <div class="panel-body">
                <div class="container">
                    <div class="row col-md-5">
                        <table class="table table-striped" id="someid">
                            <tr>
                                <td>ชื่อ-สกุล  :</td>
                                <td id="personNAME"><?php //echo $person->NAME.' - '.$person->LNAME;?></td>
                            </tr>
                            <tr>
                                <td>อายุ (ปี) :</td>
                                <td id="age"><?php //echo $person->AGE;?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td id="address"><?php ///echo 'บ้านเลขที่   >   '.$person->HOUSE .'  หมู่ที่      >'.$person->VILLAGE_ID.'  บ้าน    >'.$person->MOOBAN;?></td>
                            </tr>
                            <tr>
                                <td>โรคเรื้อรัง :</td>
                                <td id="disease"><?php //echo $person->DM_DX.$person->HT_DX ?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
          
        <div class="panel panel-success">
            
            <form id="formLab" method="post" action="#">
                <input type="hidden" id="labId" name="id" value=""/>
                <div class="panel-body">
                    มี&nbsp;<input type="radio" id="blood1" name="blood" value="1" />&nbsp;ไม่มี&nbsp;<input type="radio" id="blood0" name="blood" value="0" />
                    <br>
                    มี&nbsp;<input type="radio" id="urine1" name="urine" value="1" />&nbsp;ไม่มี&nbsp;<input type="radio" id="urine0" name="urine" value="0" />
                </div>
            </form>
            
            <button type="button" onclick="updateLab()">submit</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


