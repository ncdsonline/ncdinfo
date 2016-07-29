<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronics */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Me Chronics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-chronics-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'ID',
            'HOSPCODE',
            'HOSPNAME',
            'PID',
            'CID',
            'NAME',
            'LNAME',
            'BIRTH',
            'AGE',
            'SEX',
            'TYPEAREA',
            'DISCHARGE',
            'DDISCHARGE',
            'HOUSE',
            'VILLAGE_ID',
            'MOOBAN',
            'TAMBON_ID',
            'TAMBON',
            'AMPUR',
            'CHANGWAT',
            'DM_DATE_DX',
            'DM_DX',
            'DM_TYPEDISCH',
            'HT_DATE_DX',
            'HT_DX',
            'HT_TYPEDISCH',
            'RENAL_DATE_DX',
            'RENAL_DX',
            'RENAL_TYPEDISCH',
            'ISCHEMIC_DATE_DX',
            'ISCHEMIC_DX',
            'ISCHEMIC_TYPEDISCH',
            'STROKE_DATE_DX',
            'STROKE_DX',
            'STROKE_TYPEDISCH',
            'COPD_DATE_DX',
            'COPD_DX',
            'COPD_TYPEDISCH',
            'ASTHMA_DATE_DX',
            'ASTHMA_DX',
            'ASTHMA_TYPEDISCH',
            'CA_DATE_DX',
            'CA_DX',
            'CA_TYPEDISCH',
        ],
    ]) ?>

</div>
