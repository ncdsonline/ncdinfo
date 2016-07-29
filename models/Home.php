<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "home".
 *
 * @property string $HOSPCODE
 * @property string $HID
 * @property string $HOUSE
 * @property string $ROAD
 * @property string $VILLAGE
 * @property string $TAMBON
 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'HID', 'HOUSE', 'ROAD', 'VILLAGE', 'TAMBON'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => 'Hospcode',
            'HID' => 'Hid',
            'HOUSE' => 'บ้านเลขที่',
            'ROAD' => 'ถนน',
            'VILLAGE' => 'หมู่บ้าน',
            'TAMBON' => 'ตำบล',
        ];
    }
}
