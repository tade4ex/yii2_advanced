<?php

use yii\db\Migration;

/**
 * Class m180415_113026_user_sub
 */
class m180415_113026_user_sub extends Migration
{
    public function up()
    {
        $this->createTable('user_sub', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'user_sub_status_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user_sub');
    }
}
