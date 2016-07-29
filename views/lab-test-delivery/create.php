<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MeLabdelivery */

$this->title = 'Create Me Labdelivery';
$this->params['breadcrumbs'][] = ['label' => 'Me Labdeliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-labdelivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
