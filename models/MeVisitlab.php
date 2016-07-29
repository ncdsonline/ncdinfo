<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "me_visitlab".
 *
 * @property integer $ID
 * @property string $HOSPCODE
 * @property string $CID
 * @property string $BLOOD
 * @property string $URINE
 * @property string $CREATED_AT
 * @property integer $UPDATED_AT
 * @property string $CREATED_BY
 */
class MeVisitlab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $dateexam;
    public static function tableName()
    {
        return 'me_visitlab';
    }
    
    
    public function behaviors()
    {
//        return [
//            [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'CREATED_AT',
//                'updatedAtAttribute' => 'UPDATED_AT',
//                'value' => new Expression('NOW()'),
//            ],
//        ];
    return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATED_AT', 'UPDATED_AT'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'UPDATED_AT',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CID'], 'required','message' => 'Current password cannot be blank.' ],
            [['CREATED_AT','UPDATED_AT'], 'safe'],
        
            [['HOSPCODE'], 'string', 'max' => 5],
            [['CID'], 'string', 'max' => 13],
            [['BLOOD', 'URINE'], 'string', 'max' => 1],
            [['CREATED_BY'], 'string', 'max' => 3],
            [['UPDATED_AT', 'DATE_SPECIMEN'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HOSPCODE' => 'รหัสหน่วยบริการ',
            'CID' => 'เลขประจำตัว ปชช.',
            'BLOOD' => 'เลือด',
            'URINE' => 'ปัสสาวะ',
            'CREATED_AT' => 'วันเวลาที่บันทึกข้อมูล',
            'UPDATED_AT' => 'Updated  At',
            'CREATED_BY' => 'Created  By',
        ];
    }
    public static function find()
    {
        return new MeVisitlabQuery(get_called_class());
    }
    // relation 
    public function getMechronicregist(){
        return $this->hasOne(MeChronicregist::className(), ['CID'=>'CID','HOSPCODE'=>'HOSPCODE']);
    }
}
