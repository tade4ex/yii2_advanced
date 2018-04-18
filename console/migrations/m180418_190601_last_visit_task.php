<?php

use yii\db\Migration;

/**
 * Class m180418_190601_last_visit_task
 */
class m180418_190601_last_visit_task extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('last_visit_task', [
            'id' => $this->primaryKey(),
            'task_id' => $this->string()->notNull(),
            'created_at' => $this->dateTime(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('last_visit_task');
    }
}
