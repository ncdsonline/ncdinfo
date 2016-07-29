<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diabetes */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Diabetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diabetes-view">

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
            'SEX',
            'TYPEAREA',
            'DISCHARGE',
            'DDISCHARGE',
            'HOUSE',
            'VILLAGE',
            'VILLAGENAME',
            'TAMBON',
            'SUBDISTNAME',
            'AMPUR',
            'CHANGWAT',
            'DATE_DX',
            'DX',
            'TYPEDISCH',
            'DATE_COMORBI',
            'COMORBI',
            'HOSP_RX',
        ],
    ]) ?>

</div>
