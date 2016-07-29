<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $office_id
 * @property integer $usertype
 * @property string $photo
 * @property integer $count_login
 * @property string $last_login
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','office_id','firstname','lastname'], 'required'],
            [['user_id', 'usertype', 'count_login'], 'integer'],
            [['last_login'], 'safe'],
            [['firstname', 'lastname', 'office_id', 'photo'], 'string', 'max' => 255],
            ['photo', 'required', 'message' => 'กรุณาแนบไฟล์รูปภาพประจำตัวคุณ โดยแนะนำให้ใช้ภาพขนาด 160x160 px'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'firstname' => 'ชื่อจริง',
            'lastname' => 'นามสกุลจริง',
            'office_id' => 'หน่วยงาน',
            'usertype' => 'Usertype',
            'photo' => 'รูปภาพประจำตัว',
            'count_login' => 'Count Login',
            'last_login' => 'Last Login',
        ];
    }
    
        public function getChospital(){
        return $this->hasOne(Chospital::className(), ['hoscode'=>'office_id']);
    }
    
}
