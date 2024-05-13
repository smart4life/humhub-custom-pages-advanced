<?php

use humhub\components\Migration;

/**
 * Class m220914_064511_initial
 */
class m220914_064511_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->safeCreateTable('custom_pages_advanced_page', [
            'id' => $this->primaryKey(),
            'custom_pages_page_id' => $this->integer(11)->notNull(),
            'new_target' => $this->string(255),
            'allowed_group_ids' => $this->string(1023),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(11),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(11),
        ], '');

        // Add indexes on columns for speeding where operations ; false if values (or values combinaisons if several columns) are not unique
        $this->safeCreateIndex('idx-custom_pages_advanced_page', 'custom_pages_advanced_page', ['custom_pages_page_id'], true);
        // Add foreign keys (if related to a table, when deleted in this table, related rows are deleted to, but beforeDelete() and afterDelete() are not called)
        $this->safeAddForeignKey('fk-custom_pages_advanced_page-custom_pages_page', 'custom_pages_advanced_page', 'custom_pages_page_id', '`custom_pages_page`', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220914_064511_initial cannot be reverted.\n";

        return false;
    }
}
