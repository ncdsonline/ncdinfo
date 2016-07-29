<?php
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$form = ActiveForm::begin();
echo '<label class="control-label">Select date range</label>';
echo '<label class="col-xs-4 col-sm-4 col-md-3 col-lg-3 control-label">Date Monitoring Performed:</label>';
  echo DatePicker::widget([
      $start_date='start_date',
    'name' => 'start_date', 
    'value' => date('d-M-Y'),
    'options' => ['placeholder' => ' '],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true,
        'autoclose' => true,
    ]
  ]);
  
ActiveForm::end();
?>
<div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
<!-- 
// Setting datepicker for your regional language (e.g. fr for French)
echo '<label class="control-label">Date de Naissance</label>';
echo DatePicker::widget([
    'name' => 'date_10',
    'language' => 'fr',
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose' => true,
    ]
]);
 
// Highlight today, show today button, change date format
echo '<label class="control-label">Birth Date</label>';
echo DatePicker::widget([
    'name' => 'date_11',
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'format' => 'dd-M-yyyy',
        'autoclose' => true,
    ]
]);
 
// Show week numbers and disable certain days of week (e.g. weekends)
echo '<label class="control-label">Birth Date</label>';
echo DatePicker::widget([
    'name' => 'date_12',
    'value' => '31-Dec-2010',
    'pluginOptions' => [
        'calendarWeeks' => true,
        'daysOfWeekDisabled' => [0, 6],
        'format' => 'dd-M-yyyy',
        'autoclose' => true,
    ]
]);
 
// Change orientation of datepicker as well as markup type
echo '<label class="control-label">Setup Date</label>';
echo DatePicker::widget([
    'name' => 'date_12',
    'value' => '08/10/2004',
    'type' => DatePicker::TYPE_COMPONENT_APPEND,
    'pluginOptions' => [
        'orientation' => 'top right',
        'format' => 'mm/dd/yyyy',
        'autoclose' => true,
    ]
]);
 
 
// Multiple Dates Selection
echo '<label class="control-label">Select Dates</label>';
echo DatePicker::widget([
    'name' => 'date_12',
    'value' => '08/10/2004',
    'type' => DatePicker::TYPE_COMPONENT_APPEND,
    'pluginOptions' => [
        'format' => 'mm/dd/yyyy',
        'multidate' => true,
        'multidateSeparator' => ' ; ',
    ]
]);
 -->
