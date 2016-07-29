<?php

namespace app\models;

use yii\base\Model;

class ScreenSearchForm extends Model {


    public $agestart;
    public $agestop;      
    public $year_id; 


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           

            ['agestart', 'required', 'message' => 'กรุณากำหนดอายุเริ่มต้น'],
            ['agestop', 'required', 'message' => 'กรุณากำหนดอายุสิ้นสุด'],
            [['agestart','agestop'],'integer', 'message' => 'กรุณาป้อนเป็นตัวเลขจำนวนเต็ม'],
            
            ['year_id', 'required', 'message' => 'กรุณาเลือกปี'],

        ];
    }

}
