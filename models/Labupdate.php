<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labupdate".
 *
 * @property integer $ID
 * @property string $CID
 * @property string $DATE_SERV
 * @property string $n
 *
 * @property Person $c
 */
class Labupdate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labupdate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['n'], 'integer'],
            [['CID', 'DATE_SERV'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CID' => 'Cid',
            'DATE_SERV' => 'Date  Serv',
            'n' => 'N',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasMany(Person::className(), ['CID' => 'CID']);
    }
//       public function getPerson()
//    {
//    
//        return $this->hasMany(Person::className(), ['CID' => 'CID']);
//    }
}
