<?php

namespace drtsb\yii\seo\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `seo_model`.
 */
class m190313_070517_create_seo_model_table extends Migration
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
 
        $this->createTable('seo_model', [
            'id' => $this->primaryKey(),
            'model_name' => $this->string()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_canonical' => $this->string()->defaultValue(null),
            'meta_noindex' => $this->boolean()->notNull()->defaultValue(false),
            'meta_nofollow' => $this->boolean()->notNull()->defaultValue(false),
            'use_common' => $this->boolean()->notNull()->defaultValue(false),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable( 'seo_model' );
    }
}
