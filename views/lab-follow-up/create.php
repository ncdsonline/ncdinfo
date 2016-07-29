<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Labfu */

$this->title = 'Create Labfu';
$this->params['breadcrumbs'][] = ['label' => 'Labfus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labfu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
