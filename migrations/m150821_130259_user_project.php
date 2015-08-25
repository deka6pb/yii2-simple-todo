<?php

use yii\db\Migration;
use yii\db\Schema;

class m150821_130259_user_project extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_project}}', [
            'id'            => Schema::TYPE_PK,
            'user_id'       => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id'    => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('upproject', '{{%user_project}}', 'project_id', '{{%project}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('upuser', '{{%user_project}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m150821_130259_user_project cannot be reverted.\n";

        $this->dropTable('{{%user_project}}');

        return false;
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
