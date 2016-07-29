<?php
namespace app\commands;
use yii\console\Controller;
// use yii\app\Controller;
use yii\helpers\Console;
use Yii;


class RbacController extends Controller {
    public function actionInit() {
//        echo 'test console'; 
//        Console::output('test test test');
      $auth = Yii::$app->authManager;
      $auth->removeAll();
      
      // add role this type=1
      $admin = $auth->createRole('Admin');
      $admin->description = 'ผู้ดูแลระบบ';
      $auth->add($admin);
      Console::output('Admin already');
      
      $manager = $auth->createRole('Manager');
      $manager->description = 'PM';
      $auth->add($manager);
      Console::output('Manager already');
      
      $member = $auth->createRole('Member');
      $member->description = 'สมาชิก';
      $auth->add($member);
      Console::output('Manager already');
      
      $user = $auth->createRole('User');
      $user->description = 'ผู้ใช้งานทั่วไป';
      $auth->add($user);
      Console::output('User already');
      

      
       // add permission this type=2
      
      
      $index= $auth->createPermission('index');
      $auth->add($index);
      $auth->addChild($user,$index);     
      Console::output('index is OK');
      
      $view= $auth->createPermission('view');
      $auth->add($view);
      $auth->addChild($user,$view);     
      Console::output('view is OK');
      
      $list= $auth->createPermission('list');
      $auth->add($list);
      $auth->addChild($member,$list);     
      Console::output('list is OK');
      
      $create= $auth->createPermission('create');
      $auth->add($create);
      $auth->addChild($manager,$create);     
      Console::output('create is OK');
      
      $delete= $auth->createPermission('delete');
      $auth->add($delete);
      $auth->addChild($manager,$delete);     
      Console::output('delete is OK');
      
      $update= $auth->createPermission('update');
      $auth->add($update);
      $auth->addChild($manager,$update);     
      Console::output('update is OK');
      
      
      
      // rule = isAuthor
      // เรียกใช้งาน AuthorRule
//    $rule = new \commands\RbacRule;
//    $auth->add($rule);

    // สร้าง permission ขึ้นมาใหม่เพื่อเอาไว้ตรวจสอบและนำ AuthorRule มาใช้งานกับ updateOwnPost
//      $updateownblog= $auth->createPermission('updateOwnblog');
//      $updateownblog->ruleName = $rule->name;
//      $auth->add($updateownblog);
//      
//      $auth->addChild($member,$updateownblog);     
//      Console::output('update is OK');
//      
//      $delete= $auth->createPermission('delete');
//      $auth->add($delete);
//      $auth->addChild($author,$delete);     
//      Console::output('delete is OK');
      
    
    
        $auth->addChild($member,$user);
        $auth->addChild($manager,$user);
        $auth->addChild($admin,$member);
        $auth->addChild($admin,$manager);
      
      Console::output('All child is already');
      
      $auth->assign($admin, 1);
      $auth->assign($manager, 2);
      $auth->assign($member, 3);
      $auth->assign($user, 4);
      
//      $auth->assign($management, 2);
//      $auth->assign($author, 3);
//      $auth->assign($author, 4);

      Console::output('Success! RBAC roles has been added.');
      
      
    }
}
