<?php

use yii\db\Migration;

/**
 * Class m180402_130211_project
 */
class m180402_130211_project extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-project-user_id', 'project', 'user_id');

        $this->addForeignKey('fk-project-user_id', 'project', 'user_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk-project-user_id', 'project');
        $this->dropTable('project');
    }
}
