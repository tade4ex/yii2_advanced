<?php

use yii\db\Migration;

/**
 * Class m180402_130215_task_container
 */
class m180402_130215_task_container extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('task_container', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-task_container-user_id', 'task_container', 'user_id');
        $this->createIndex('idx-task_container-project_id', 'task_container', 'project_id');

        $this->addForeignKey('fk-task_container-user_id', 'task_container', 'user_id', 'user', 'id');
        $this->addForeignKey('fk-task_container-project_id', 'task_container', 'project_id', 'project', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk-task_container-user_id', 'task_container');
        $this->dropForeignKey('fk-task_container-project_id', 'task_container');
        $this->dropTable('task_container');
    }
}
