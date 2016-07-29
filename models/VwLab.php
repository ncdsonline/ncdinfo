<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_lab".
 *
 * @property string $CID
 * @property string $DATE_SERV
 * @property string $n
 */
class VwLab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_lab';
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
            'CID' => 'Cid',
            'DATE_SERV' => 'Date  Serv',
            'n' => 'N',
        ];
    }
}
