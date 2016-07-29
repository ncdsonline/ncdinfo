<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab".
 *
 * @property integer $ID
 * @property string $CID
 * @property string $SEQ
 * @property string $DATE_SERV
 * @property string $LABTEST
 * @property string $LABNAME
 * @property string $LABRESULT
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CID', 'SEQ', 'DATE_SERV', 'LABTEST', 'LABNAME', 'LABRESULT'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CID' => 'เลขบัตรประชาชน',
            'SEQ' => 'Seq',
            'DATE_SERV' => 'วันที่รับบริการ',
            'LABTEST' => 'Labtest',
            'LABNAME' => 'Labname',
            'LABRESULT' => 'Labresult',
        ];
    }
      public function getPerson()
    {
    
        return $this->hasMany(Person::className(), ['CID' => 'CID']);
    }
}
