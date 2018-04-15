<?php

use yii\db\Migration;

/**
 * Class m180415_122809_user_sub
 */
class m180415_122809_user_sub extends Migration
{
    public function up()
    {
        $this->dropColumn('user_sub', 'user_sub_status_id');
        $this->addColumn('user_sub', 'user_sub_event_id', $this->integer()->notNull());
    }
}
