<?php
 echo Yii::$app->user->id.'<br>';
//echo $myname;
//if( Yii::$app->user->identity->role <> 10){
//    return  Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
//                          Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE' => $data['HOSPCODE']]))
//                        :'' ;
//                      }else {
//                          return  Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE'=> $data['HOSPCODE']]));
//                      }
if(Yii::$app->user->can('Admin')){
    echo 'U R Admin'.'<br>';
   
}elseif (Yii::$app->user->can('Member')) {
     echo 'U R Member'.'<br>';
    
}  else {
    return false;
}