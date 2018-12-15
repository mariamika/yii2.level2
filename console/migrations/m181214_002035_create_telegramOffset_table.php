<?php

use yii\db\Migration;

/**
 * Handles the creation of table `telegramOffset`.
 */
class m181214_002035_create_telegramOffset_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('telegramOffset', [
            'id' => $this->integer(),
            'timestamp_offset' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegramOffset');
    }
}
