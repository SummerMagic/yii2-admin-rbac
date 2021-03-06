<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%supper_users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%supper_users}}', [
            'username'=>'admin',
            'auth_key'=>'hvZzT1yrMJgMO_JbdOafhjzw9RYx6PzZ',
            'password_hash'=>'$2y$13$1pfOkptg.5VusspwCpC6xuHa2dlOenZJpPWWhhntwOCcAb1NkbsI2',
            'password_reset_token'=>null,
            'email'=>'homestead@domain.com',
            'status'=>10,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%supper_users}}');
    }
}
