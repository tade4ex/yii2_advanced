<?php

use yii\db\Migration;

/**
 * Class m180404_182020_chat
 */
class m180404_182020_chat extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'user_from_id' => $this->integer()->notNull(),
            'user_to_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'send_at' => $this->dateTime()->notNull(),
            'seen_at' => $this->dateTime(),
            'seen' => $this->boolean()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('chat');
    }
}
