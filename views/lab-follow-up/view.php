<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Labfu */

$this->title = $model->HOSPCODE;
$this->params['breadcrumbs'][] = ['label' => 'Labfus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labfu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'HOSPCODE' => $model->HOSPCODE, 'PID' => $model->PID, 'SEQ' => $model->SEQ, 'LABTEST' => $model->LABTEST], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'HOSPCODE' => $model->HOSPCODE, 'PID' => $model->PID, 'SEQ' => $model->SEQ, 'LABTEST' => $model->LABTEST], [
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
            'HOSPCODE',
            'PID',
            'SEQ',
            'DATE_SERV',
            'LABTEST',
            'LABRESULT',
            'D_UPDATE',
        ],
    ]) ?>

</div>
