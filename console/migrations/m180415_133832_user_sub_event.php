<?php

use yii\db\Migration;

/**
 * Class m180415_133832_user_sub_event
 */
class m180415_133832_user_sub_event extends Migration
{
    public function up()
    {
        $this->createTable('user_sub_event', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        $this->insert('user_sub_event', ['name' => 'Create new project',]);
        $this->insert('user_sub_event', ['name' => 'Update project',]);
        $this->insert('user_sub_event', ['name' => 'Create new task',]);
        $this->insert('user_sub_event', ['name' => 'CUpdate task',]);
    }

    public function down()
    {
        $this->dropTable('user_sub_event');
    }
}
