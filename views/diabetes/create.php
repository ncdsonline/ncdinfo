<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Diabetes */

$this->title = 'Create Diabetes';
$this->params['breadcrumbs'][] = ['label' => 'Diabetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diabetes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
