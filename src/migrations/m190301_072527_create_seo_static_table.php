<?php

namespace drtsb\yii\seo\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `seo_static`.
 */
class m190301_072527_create_seo_static_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('seo_static', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'controller' => $this->string()->notNull(),
            'action' => $this->string()->notNull(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),
            'rel_canonical' => $this->string()->defaultValue(null),
            'meta_noindex' => $this->boolean()->notNull()->defaultValue(false),
            'meta_nofollow' => $this->boolean()->notNull()->defaultValue(false),
        ], $tableOptions);

        $this->insert('seo_static', [
            'created_at' => time(),
            'updated_at' => time(),
            'controller' => '*',
            'action' => '*',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('seo_static');
    }
}
