<?php

namespace app\models;

use yii\base\Model;

class LabQueueSearchForm extends Model {


    public $datestart;
    public $datestop;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [

            [['datestart','datestop'], 'required', 'message' => 'กรุณาระบุวันที่'],


        ];
    }

}
