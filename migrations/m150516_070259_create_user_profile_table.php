<?php

use yii\db\Schema;
use yii\db\Migration;

class m150516_070259_create_user_profile_table extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id'=>  Schema::TYPE_PK,
            'username'=>  Schema::TYPE_STRING.' NOT NULL',
            'auth_key'=>  Schema::TYPE_STRING,
            'password_hash'=>Schema::TYPE_STRING.' NOT NULL',
            'password_reset_token'=>  Schema::TYPE_STRING,
            'email'=>Schema::TYPE_STRING.' NOT NULL',
            'role'=>Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'status'=>Schema::TYPE_SMALLINT,
            'created_at'=>Schema::TYPE_TIMESTAMP,
            'updated_at'=>Schema::TYPE_TIMESTAMP,
        ]);
        $this->createIndex('username', 'user', 'username', true);
        $this->createIndex('email', 'user', 'email',true);
        
        $this->createTable('profile', [
            'id'=>Schema::TYPE_PK,
            'user_id'=>  Schema::TYPE_INTEGER.' NOT NULL',
            'firstname'=>  Schema::TYPE_STRING,
            'lastname'=>  Schema::TYPE_STRING,
            'office_id'=>  Schema::TYPE_STRING,
            'usertype' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'photo'=>  Schema::TYPE_STRING,
        ]);
        // table tmp_me_epi4report
        
        // table lablastdate
        
        // 
        $security = Yii::$app->security;
        
        $this->batchInsert('user', ['username','auth_key','password_hash','email','role','status','created_at'], 
        [['admin',$security->generateRandomString(),$security->generatePasswordHash('admin'),'admin@admin.com',10,1,date("Y-m-d H:i:s")]]);
        $this->batchInsert('profile', ['user_id','firstname','lastname'], 
                [[1,'Administrator','Section']]);
    }

    public function down()
    {
        $this->dropTable('profile');
        $this->dropTable('user');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
