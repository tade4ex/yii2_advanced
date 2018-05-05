<?php

use yii\db\Migration;

/**
 * Class m180505_140437_user
 */
class m180505_140437_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', $this->integer()->defaultValue(10));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
