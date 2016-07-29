<?php

namespace app\models;

use yii\base\Model;

class ChronicSearchForm extends Model {

    public $dx_start;
    public $dx_stop;
    
    public $agestart;
    public $agestop;
        
    public $sex;
    
    public $maininscl;
    
     public $disease;
    public $year_id; 


    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           
            [['dx_start','dx_stop'], 'required', 'message' => 'กรุณาเลือกวันที่วินิจฉัยโรค '],
            
           // [['agestop'], 'required', 'message' => 'กรุณาระบุอายุเป็นตัวเลข'],
             ['agestart', 'integer'],
            ['agestop', 'integer'],
            //['agestart', 'default', 'value' => 0],

            ['sex', 'required', 'message' => 'กรุณาเลือกหน่วยบริการ '],
            
            ['maininscl', 'required', 'message' => 'กรุณาเลือกสิทธิการรักษา'],
            
            ['disease', 'required', 'message' => 'กรุณาเลือกโรคเรื้อรัง'],
            
            ['year_id', 'required', 'message' => 'กรุณาเลือกปี'],

        ];
    }

}
