<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MeChronics */

$this->title = 'Create Me Chronics';
$this->params['breadcrumbs'][] = ['label' => 'Me Chronics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-chronics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
