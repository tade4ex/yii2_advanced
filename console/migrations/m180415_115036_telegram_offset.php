<?php

use yii\db\Migration;

/**
 * Class m180415_115036_telegram_offset
 */
class m180415_115036_telegram_offset extends Migration
{
    public function up()
    {
        $this->createTable('telegram_offset', [
            'id' => $this->primaryKey(),
            'offset' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('telegram_offset');
    }
}
