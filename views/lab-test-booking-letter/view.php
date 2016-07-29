<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregist */

$this->title ='ข้อมูลสิ่งส่งตรวจของผู้ป่วยปรับปรุงล่าสุด' ;
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->CID;
?>
<div class="box box-success box-solid">
        <div class="box-header">
            <h4><?php echo 'รายละเอียด';?></h4>
        </div>   
    <div class="box-body">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CID',
            'mechronicregist.NAME',
            'mechronicregist.LNAME',
           // 'BLOOD',   
            [
                'attribute' => 'เลือด',
                'format'=>'raw',
                'value' => $model->BLOOD == 1 ? 'มีสิ่งส่งตรวจ' : 'ไม่มีสิ่งส่งตรวจ'
            ],
            //'URINE',
            [
                'attribute' => 'ปัสสาวะ',
                'format'=>'raw',
                'value' => $model->URINE == 1 ? 'มีสิ่งส่งตรวจ' : 'ไม่มีสิ่งส่งตรวจ'
            ],

          //  'UPDATED_AT',
        ]
    ]) ?>
    </div>
</div>
