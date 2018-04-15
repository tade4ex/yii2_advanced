<?php

use yii\db\Migration;

/**
 * Class m180415_122039_user_sub
 */
class m180415_122039_user_sub extends Migration
{
    public function up()
    {
        $this->addColumn('user_sub', 'telegram_user_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('user_sub', 'telegram_user_id');
    }
}
