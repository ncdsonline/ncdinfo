<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Labupdate */

$this->title = 'Create Labupdate';
$this->params['breadcrumbs'][] = ['label' => 'Labupdates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labupdate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
