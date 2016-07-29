<?php
use yii\helpers\Html;
use yii\helpers\Url;


echo "this is service  deliver";
?>
<?= Html::a('label', ['/controller/action'], ['class'=>'btn btn-primary']) ?>


<?php // use yii\helpers\Html; ?>
        <div class="pull-right btn-group">
        <?php echo Html::a('Update', array('site/update', 'id' =>'#'), array('class' => 'btn btn-primary')); ?>
        <?php echo Html::a('Delete', array('site/delete', 'id' =>'#'), array('class' => 'btn btn-danger')); ?>
        </div>