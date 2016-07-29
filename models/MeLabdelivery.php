<?php

namespace app\models;

use Yii;
use app\models\Person;

/**
 * This is the model class for table "me_labdelivery".
 *
 * @property string $ID
 * @property string $CID
 * @property string $HOSPCODE
 * @property string $PID
 * @property string $SEQ
 * @property string $DATE_SERV
 * @property string $LABTEST
 * @property integer $LABRESULT
 * @property string $D_UPDATE
 * @property string $UPDATED_AT
 *
 * @property Person $c
 */
class MeLabdelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_labdelivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'PID', 'SEQ', 'DATE_SERV', 'LABTEST', 'LABRESULT', 'D_UPDATE', 'UPDATED_AT'], 'required'],
            [['DATE_SERV', 'D_UPDATE', 'UPDATED_AT'], 'safe'],
            [['LABRESULT'], 'integer'],
            [['CID'], 'string', 'max' => 13],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['PID'], 'string', 'max' => 15],
            [['SEQ'], 'string', 'max' => 16],
            [['LABTEST'], 'string', 'max' => 7]
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
            'HOSPCODE' => 'Hospcode',
            'PID' => 'Pid',
            'SEQ' => 'Seq',
            'DATE_SERV' => 'Date  Serv',
            'LABTEST' => 'Labtest',
            'LABRESULT' => 'Labresult',
            'D_UPDATE' => 'D  Update',
            'UPDATED_AT' => 'Updated  At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    

    /**
     * @inheritdoc
     * @return MeLabdeliveryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeLabdeliveryQuery(get_called_class());
    }
    
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['HOSPCODE' => 'HOSPCODE','PID'=>'PID']);
    }
    
    public function getMechronicregist()
    {
        return $this->hasOne(MeChronicregist::className(), ['CID' => 'CID']);
    }
}
