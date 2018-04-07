<?php

use yii\db\Migration;

/**
 * Class m180407_084735_project
 */
class m180407_084735_project extends Migration
{
    public function up()
    {
        $this->addColumn('project', 'complete', $this->boolean());
        $this->addColumn('project', 'parent_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('project', 'complete');
        $this->dropColumn('project', 'parent_id');
    }
}
