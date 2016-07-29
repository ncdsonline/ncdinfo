<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_diabetes".
 *
 * @property integer $ID
 * @property string $HOSPCODE
 * @property string $HOSPNAME
 * @property string $PID
 * @property string $CID
 * @property string $NAME
 * @property string $LNAME
 * @property string $BIRTH
 * @property string $SEX
 * @property string $TYPEAREA
 * @property string $DISCHARGE
 * @property string $DDISCHARGE
 * @property string $HOUSE
 * @property string $VILLAGE
 * @property string $VILLAGENAME
 * @property string $TAMBON
 * @property string $SUBDISTNAME
 * @property string $AMPUR
 * @property string $CHANGWAT
 * @property string $DATE_DX
 * @property string $DX
 * @property string $TYPEDISCH
 * @property string $DATE_COMORBI
 * @property string $COMORBI
 * @property string $HOSP_RX
 */
class Diabetes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_diabetes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BIRTH', 'DDISCHARGE'], 'safe'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['HOSPNAME', 'NAME', 'LNAME'], 'string', 'max' => 50],
            [['PID'], 'string', 'max' => 15],
            [['CID'], 'string', 'max' => 13],
            [['SEX', 'TYPEAREA', 'DISCHARGE'], 'string', 'max' => 1],
            [['HOUSE'], 'string', 'max' => 75],
            [['VILLAGE', 'TAMBON', 'AMPUR', 'CHANGWAT'], 'string', 'max' => 2],
            [['VILLAGENAME', 'DATE_DX', 'DX', 'TYPEDISCH', 'DATE_COMORBI', 'COMORBI', 'HOSP_RX'], 'string', 'max' => 255],
            [['SUBDISTNAME'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HOSPCODE' => 'Hospcode',
            'HOSPNAME' => 'Hospname',
            'PID' => 'Pid',
            'CID' => 'Cid',
            'NAME' => 'Name',
            'LNAME' => 'Lname',
            'BIRTH' => 'Birth',
            'SEX' => 'Sex',
            'TYPEAREA' => 'Typearea',
            'DISCHARGE' => 'Discharge',
            'DDISCHARGE' => 'Ddischarge',
            'HOUSE' => 'House',
            'VILLAGE' => 'Village',
            'VILLAGENAME' => 'Villagename',
            'TAMBON' => 'Tambon',
            'SUBDISTNAME' => 'Subdistname',
            'AMPUR' => 'Ampur',
            'CHANGWAT' => 'Changwat',
            'DATE_DX' => 'Date  Dx',
            'DX' => 'Dx',
            'TYPEDISCH' => 'Typedisch',
            'DATE_COMORBI' => 'Date  Comorbi',
            'COMORBI' => 'Comorbi',
            'HOSP_RX' => 'Hosp  Rx',
        ];
    }
}
