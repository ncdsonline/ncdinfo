<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MeChronicregist]].
 *
 * @see MeChronicregist
 */
class MeChronicregistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return MeChronicregist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MeChronicregist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}