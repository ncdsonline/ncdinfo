<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregist */

$this->title = 'Create Me Chronicregist';
$this->params['breadcrumbs'][] = ['label' => 'Me Chronicregists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-chronicregist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
