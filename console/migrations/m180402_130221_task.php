<?php

use yii\db\Migration;

/**
 * Class m180402_130221_task
 */
class m180402_130221_task extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'task_container_id' => $this->integer()->notNull(),
            'start' => $this->dateTime(),
            'end' => $this->dateTime(),
            'complete' => $this->boolean()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-task-user_id', 'task', 'user_id');
        $this->createIndex('idx-task-project_id', 'task', 'project_id');
        $this->createIndex('idx-task-task_container_id', 'task', 'task_container_id');

        $this->addForeignKey('fk-task-user_id', 'task', 'user_id', 'user', 'id');
        $this->addForeignKey('fk-task-project_id', 'task', 'project_id', 'project', 'id');
        $this->addForeignKey('fk-task-task_container_id', 'task', 'task_container_id', 'task_container', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk-task-user_id', 'task');
        $this->dropForeignKey('fk-task-project_id', 'task');
        $this->dropForeignKey('fk-task-task_container_id', 'task');
        $this->dropTable('task');
    }
}
