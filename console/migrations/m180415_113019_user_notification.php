<?php

use yii\db\Migration;

/**
 * Class m180415_113019_user_notification
 */
class m180415_113019_user_notification extends Migration
{
    public function up()
    {
        $this->createTable('user_notification', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'user_sub_event_id' => $this->integer()->notNull(),
            'sent' => $this->boolean()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('user_notification');
    }
}
