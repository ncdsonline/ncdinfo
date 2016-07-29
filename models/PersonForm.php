<?php
namespace app\models;
use yii\base\Model;
class PersonForm extends Model{
    
    public $person;
    
    public function rules(){
        return [
            [['person'],'required'],
        ];
    }
    public function attributeLabels() {
        return [
            'person'=>'ผู้รับบริการ'
        ];
    }
}