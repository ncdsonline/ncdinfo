<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "me_chronicregist".
 *
 * @property integer $ID
 * @property string $HN_HMAIN
 * @property string $HOSPCODE
 * @property string $HOSPNAME
 * @property string $PID
 * @property string $CID
 * @property string $NAME
 * @property string $LNAME
 * @property string $BIRTH
 * @property string $AGE
 * @property string $SEX
 * @property string $TYPEAREA
 * @property string $DISCHARGE
 * @property string $DDISCHARGE
 * @property string $HOUSE
 * @property string $VILLAGE_ID
 * @property string $MOOBAN
 * @property string $TAMBON_ID
 * @property string $TAMBON
 * @property string $AMPUR
 * @property string $CHANGWAT
 * @property string $MAININSCL
 * @property string $DM_DATE_DX
 * @property string $DM_DX
 * @property string $DM_TYPEDISCH
 * @property string $DM_HOSP_RX
 * @property string $HT_DATE_DX
 * @property string $HT_DX
 * @property string $HT_TYPEDISCH
 * @property string $HT_HOSP_RX
 * @property string $RENAL_DATE_DX
 * @property string $RENAL_DX
 * @property string $RENAL_TYPEDISCH
 * @property string $RENAL_HOSP_RX
 * @property string $ISCHEMIC_DATE_DX
 * @property string $ISCHEMIC_DX
 * @property string $ISCHEMIC_TYPEDISCH
 * @property string $ISCHEMIC_HOSP_RX
 * @property string $STROKE_DATE_DX
 * @property string $STROKE_DX
 * @property string $STROKE_TYPEDISCH
 * @property string $STROKE_HOSP_RX
 * @property string $COPD_DATE_DX
 * @property string $COPD_DX
 * @property string $COPD_TYPEDISCH
 * @property string $COPD_HOSP_RX
 * @property string $ASTHMA_DATE_DX
 * @property string $ASTHMA_DX
 * @property string $ASTHMA_TYPEDISCH
 * @property string $ASTHMA_HOSP_RX
 * @property string $CA_BREAST_DATE_DX
 * @property string $CA_BREAST_DX
 * @property string $CA_BREAST_TYPEDISCH
 * @property string $CA_BREAST_HOSP_RX
 * @property string $CA_CERVIX_DATE_DX
 * @property string $CA_CERVIX_DX
 * @property string $CA_CERVIX_TYPEDISCH
 * @property string $CA_CERVIX_HOSP_RX
 * @property string $CA_COLON_DATE_DX
 * @property string $CA_COLON_DX
 * @property string $CA_COLON_TYPEDISCH
 * @property string $CA_COLON_HOSP_RX
 * @property string $UPDATE_AT
 */
class MeChronicregist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'me_chronicregist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BIRTH', 'DDISCHARGE'], 'safe'],
            [['HN_HMAIN', 'PID'], 'string', 'max' => 15],
            [['HOSPCODE', 'DM_HOSP_RX', 'HT_HOSP_RX', 'RENAL_HOSP_RX', 'ISCHEMIC_HOSP_RX', 'STROKE_HOSP_RX', 'COPD_HOSP_RX', 'ASTHMA_HOSP_RX', 'CA_BREAST_HOSP_RX', 'CA_CERVIX_HOSP_RX', 'CA_COLON_HOSP_RX'], 'string', 'max' => 255],
            [['HOSPNAME', 'NAME', 'LNAME'], 'string', 'max' => 50],
            [['CID'], 'string', 'max' => 13],
            [['AGE'], 'string', 'max' => 3],
            [['SEX', 'TYPEAREA', 'DISCHARGE'], 'string', 'max' => 1],
            [['HOUSE'], 'string', 'max' => 75],
            [['VILLAGE_ID', 'TAMBON_ID', 'AMPUR', 'CHANGWAT', 'DM_TYPEDISCH', 'HT_TYPEDISCH', 'RENAL_TYPEDISCH', 'ISCHEMIC_TYPEDISCH', 'STROKE_TYPEDISCH', 'COPD_TYPEDISCH', 'ASTHMA_TYPEDISCH', 'CA_BREAST_TYPEDISCH', 'CA_CERVIX_TYPEDISCH', 'CA_COLON_TYPEDISCH'], 'string', 'max' => 255],
            [['MOOBAN', 'DM_DATE_DX', 'DM_DX', 'HT_DATE_DX', 'HT_DX', 'RENAL_DATE_DX', 'RENAL_DX', 'ISCHEMIC_DATE_DX', 'ISCHEMIC_DX', 'STROKE_DATE_DX', 'STROKE_DX', 'COPD_DATE_DX', 'COPD_DX', 'ASTHMA_DATE_DX', 'ASTHMA_DX', 'CA_BREAST_DATE_DX', 'CA_BREAST_DX', 'CA_CERVIX_DATE_DX', 'CA_CERVIX_DX', 'CA_COLON_DATE_DX', 'CA_COLON_DX', 'UPDATE_AT'], 'string', 'max' => 255],
            [['TAMBON'], 'string', 'max' => 30],
            [['MAININSCL'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HN_HMAIN' => 'HN (รพ.พช.)',
            'HOSPCODE' => 'รหัสหน่วยบริการ',
            'HOSPNAME' => 'หน่วยบริการ',
            'PID' => 'PID',
            'CID' => 'เลขประจำตัว ปชช.',
            'NAME' => 'ชื่อ',
            'LNAME' => 'สกุล',
            'BIRTH' => 'วันเกิด',
            'AGE' => 'อายุ (ปี)',
            'SEX' => 'เพศ',
            'TYPEAREA' => 'Typearea',
            'DISCHARGE' => 'Discharge',
            'DDISCHARGE' => 'Ddischarge',
            'HOUSE' => 'บ้านเลขที่',
            'VILLAGE_ID' => 'หมู่',
            'MOOBAN' => 'หมู่บ้าน',
            'TAMBON_ID' => 'Tambon  ID',
            'TAMBON' => 'ตำบล',
            'AMPUR' => 'Ampur',
            'CHANGWAT' => 'Changwat',
            'MAININSCL' => 'Maininscl',
            'DM_DATE_DX' => 'Dm  Date  Dx',
            'DM_DX' => 'เบาหวาน',
            'DM_TYPEDISCH' => 'Dm  Typedisch',
            'DM_HOSP_RX' => 'Dm  Hosp  Rx',
            'HT_DATE_DX' => 'Ht  Date  Dx',
            'HT_DX' => 'ความดันสูง',
            'HT_TYPEDISCH' => 'Ht  Typedisch',
            'HT_HOSP_RX' => 'Ht  Hosp  Rx',
            'RENAL_DATE_DX' => 'Renal  Date  Dx',
            'RENAL_DX' => 'Renal  Dx',
            'RENAL_TYPEDISCH' => 'Renal  Typedisch',
            'RENAL_HOSP_RX' => 'Renal  Hosp  Rx',
            'ISCHEMIC_DATE_DX' => 'Ischemic  Date  Dx',
            'ISCHEMIC_DX' => 'Ischemic  Dx',
            'ISCHEMIC_TYPEDISCH' => 'Ischemic  Typedisch',
            'ISCHEMIC_HOSP_RX' => 'Ischemic  Hosp  Rx',
            'STROKE_DATE_DX' => 'Stroke  Date  Dx',
            'STROKE_DX' => 'Stroke  Dx',
            'STROKE_TYPEDISCH' => 'Stroke  Typedisch',
            'STROKE_HOSP_RX' => 'Stroke  Hosp  Rx',
            'COPD_DATE_DX' => 'Copd  Date  Dx',
            'COPD_DX' => 'Copd  Dx',
            'COPD_TYPEDISCH' => 'Copd  Typedisch',
            'COPD_HOSP_RX' => 'Copd  Hosp  Rx',
            'ASTHMA_DATE_DX' => 'Asthma  Date  Dx',
            'ASTHMA_DX' => 'Asthma  Dx',
            'ASTHMA_TYPEDISCH' => 'Asthma  Typedisch',
            'ASTHMA_HOSP_RX' => 'Asthma  Hosp  Rx',
            'CA_BREAST_DATE_DX' => 'Ca  Breast  Date  Dx',
            'CA_BREAST_DX' => 'Ca  Breast  Dx',
            'CA_BREAST_TYPEDISCH' => 'Ca  Breast  Typedisch',
            'CA_BREAST_HOSP_RX' => 'Ca  Breast  Hosp  Rx',
            'CA_CERVIX_DATE_DX' => 'Ca  Cervix  Date  Dx',
            'CA_CERVIX_DX' => 'Ca  Cervix  Dx',
            'CA_CERVIX_TYPEDISCH' => 'Ca  Cervix  Typedisch',
            'CA_CERVIX_HOSP_RX' => 'Ca  Cervix  Hosp  Rx',
            'CA_COLON_DATE_DX' => 'Ca  Colon  Date  Dx',
            'CA_COLON_DX' => 'Ca  Colon  Dx',
            'CA_COLON_TYPEDISCH' => 'Ca  Colon  Typedisch',
            'CA_COLON_HOSP_RX' => 'Ca  Colon  Hosp  Rx',
            'UPDATE_AT' => 'Update  At',
        ];
    }

    /**
     * @inheritdoc
     * @return MeChronicregistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeChronicregistQuery(get_called_class());
    }
}
