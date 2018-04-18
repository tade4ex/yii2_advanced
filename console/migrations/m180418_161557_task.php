<?php

use yii\db\Migration;

/**
 * Class m180418_161557_task
 */
class m180418_161557_task extends Migration
{
    public function up()
    {
        $this->addColumn('task', 'complete', $this->boolean()->defaultValue(0));
    }
}
