<?php

use yii\db\Migration;

class m171016_115413_add_data_to_comment extends Migration
{
    public function safeUp()
    {
        $this->addColumn('comment','date', $this->date());
    }

    public function safeDown()
    {
        $this->dropColumn('comment', 'date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171016_115413_add_data_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
