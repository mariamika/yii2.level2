<?php

use yii\db\Migration;

/**
 * Class m181125_072147_alter_performer_table
 */
class m181125_072147_alter_performer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('performer','email','string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('performer','email');
    }
}
