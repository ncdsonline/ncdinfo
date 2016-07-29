<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregist */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Me Chronicregists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-chronicregist-view">

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
            'HN_HMAIN',
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
            'MAININSCL',
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
            'CA_BREAST_DATE_DX',
            'CA_BREAST_DX',
            'CA_BREAST_TYPEDISCH',
            'CA_CERVIX_DATE_DX',
            'CA_CERVIX_DX',
            'CA_CERVIX_TYPEDISCH',
            'CA_COLON_DATE_DX',
            'CA_COLON_DX',
            'CA_COLON_TYPEDISCH',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
