<?php

use yii\db\Schema;
use yii\db\Migration;

class m150821_130228_project extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%project}}', [
            'id'        => Schema::TYPE_PK,
            'name'      => Schema::TYPE_STRING . '(256) NOT NULL',
            'user_id'   => Schema::TYPE_INTEGER . '(11) NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        echo "m150821_130228_project cannot be reverted.\n";

        $this->dropTable('{{%project}}');

        return false;
    }
}
