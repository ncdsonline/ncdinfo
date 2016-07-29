<?php

use yii\helpers\Html;


$this->title = 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'แก้ไขข้อมูล :'.$model->CID;
?>

<div class="me-chronicregist-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'person'=>$person,
    ]) ?>

</div>
