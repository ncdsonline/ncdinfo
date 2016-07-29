<?php

namespace app\models;
use \Yii;
/**
 * This is the ActiveQuery class for [[MeLabdelivery]].
 *
 * @see MeLabdelivery
 */
class MeLabdeliveryQuery extends \yii\db\ActiveQuery
{
    public function selectLastRecord($pid,$seq){
      return Yii::$app->db->createCommand("
        SELECT DATE_SERV,SEQ,LABTEST,LABRESULT
        FROM me_labdelivery
        WHERE 	PID = :PID and SEQ < :SEQ
        GROUP BY SEQ
        ORDER BY SEQ DESC
        LIMIT 1",
        [
          ':PID'=>$pid,
          ':SEQ'=>$seq
        ])->queryOne();
    }

    public function labCompare($pid,$seqSelect){
        if(($beforeRecrod = $this->selectLastRecord($pid,$seqSelect)) != null){
            return Yii::$app->db->createCommand("
                SELECT *
                FROM
                    (
                    SELECT *
                    FROM me_labdelivery
                    WHERE SEQ = :SEQ_SELECT
                    )AS labfu_select
                    LEFT JOIN
                    (
                    SELECT LABTEST as LABTEST_BEFORE,LABRESULT AS LABRESULT_BEFORE
                    FROM  me_labdelivery
                    WHERE SEQ = :SEQ_BEFORE
                    )labfu_before 
                    ON labfu_before.LABTEST_BEFORE = labfu_select.LABTEST",
                    [
                        ':SEQ_SELECT'=>$seqSelect,
                        ':SEQ_BEFORE'=>$beforeRecrod['SEQ']
                    ])->queryAll();
        }
        else{
            return Yii::$app->db->createCommand("
                    SELECT * 
                    FROM me_labdelivery
                    WHERE SEQ = :SEQ_SELECT",
                    [
                        ':SEQ_SELECT'=>$seqSelect
                    ])->queryAll();
        }

    }

    public function bySeq()
    {
        $this->select('*, count(*) as n')
             ->orderBy('DATE_SERV DESC')
             ->groupBy('SEQ');//->having('n>1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return Labfu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Labfu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}