<?php

use yii\db\Migration;
use yii\db\Schema;

class m150821_130246_todo extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%todo}}', [
            'id'                => Schema::TYPE_PK,
            'project_id'        => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'user_id'           => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'author_id'         => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'text'              => Schema::TYPE_TEXT,
            'status'            => 'tinyint(1) NOT NULL',
            'type'              => 'tinyint(1) NOT NULL',
            'date_start'        => Schema::TYPE_DATETIME . ' NOT NULL',
            'duration_minute'   => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'created'           => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('tproject', '{{%todo}}', 'project_id', '{{%project}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('tuser', '{{%todo}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('tauthor', '{{%todo}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m150821_130246_todo cannot be reverted.\n";

        $this->dropTable('{{%todo}}');

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
