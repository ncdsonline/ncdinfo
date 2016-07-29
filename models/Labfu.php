<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "labfu".
 *
 * @property string $HOSPCODE
 * @property string $PID
 * @property string $SEQ
 * @property string $DATE_SERV
 * @property string $LABTEST
 * @property integer $LABRESULT
 * @property string $D_UPDATE
 */
class Labfu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'labfu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'PID', 'SEQ', 'DATE_SERV', 'LABTEST', 'LABRESULT', 'D_UPDATE'], 'required'],
            [['DATE_SERV', 'D_UPDATE'], 'safe'],
            [['LABRESULT'], 'integer'],
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
            'HOSPCODE' => 'Hospcode',
            'PID' => 'Pid',
            'SEQ' => 'Seq',
            'DATE_SERV' => 'Date  Serv',
            'LABTEST' => 'Labtest',
            'LABRESULT' => 'Labresult',
            'D_UPDATE' => 'D  Update',
        ];
    }

    /**
     * @inheritdoc
     * @return LabfuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LabfuQuery(get_called_class());
    }
    
    // relation to person 
    public function getPerson(){
        return $this->hasOne(Person::className(), ['HOSPCODE'=>'HOSPCODE','PID'=>'PID']);
    }
    
    // relation to Chospital 
    public function getChospital(){
        return $this->hasOne(Chospital::className(), ['hoscode'=>'HOSPCODE']);
    }
    
}
