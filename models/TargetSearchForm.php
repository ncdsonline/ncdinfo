<?php

namespace app\models;

use yii\base\Model;

class TargetSearchForm extends Model {

    public $yearreport;
    public $hospcode;
    public $agestart;
    public $agestop;
    public $datestart;
    public $datestop;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           
            ['yearreport', 'required', 'message' => 'กรุณาเลือกปีงบประมาณ '],
            ['hospcode', 'required', 'message' => 'กรุณาเลือกหน่วยบริการ '],
            ['agestart', 'required', 'message' => 'กรุณากำหนดอายุเริ่มต้น'],
            ['agestop', 'required', 'message' => 'กรุณากำหนดอายุสิ้นสุด'],
            [['agestart','agestop'],'integer', 'message' => 'กรุณาป้อนเป็นตัวเลขจำนวนเต็ม'],
            [['datestart','datestop'], 'required', 'message' => 'กรุณาระบุวันเกิด'],


        ];
    }

}
