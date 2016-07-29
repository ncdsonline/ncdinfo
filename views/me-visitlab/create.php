<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlab */

$this->title = 'Create Me Visitlab';
$this->params['breadcrumbs'][] = ['label' => 'Me Visitlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-visitlab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
