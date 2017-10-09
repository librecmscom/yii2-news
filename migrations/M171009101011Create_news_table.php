<?php

namespace yuncms\news\migrations;

use yii\db\Migration;

class M171009101011Create_news_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(),
            'category_id' => $this->string()->comment('栏目ID'),
            'title' => $this->string()->notNull()->comment('标题'),
            'sub_title'=>$this->string(80)->notNull()->comment('副标题'),
            'description' => $this->string()->comment('描述'),
            'status' => $this->boolean()->defaultValue(false)->comment('状态'),
            'cover' => $this->string()->comment('封面'),
            'comments' => $this->integer()->notNull()->defaultValue(0),
            'supports' => $this->integer()->notNull()->defaultValue(0),
            'collections' => $this->integer()->notNull()->defaultValue(0),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'is_top' => $this->boolean()->notNull()->defaultValue(false)->comment('是否置顶'),
            'is_best' => $this->boolean()->notNull()->defaultValue(false)->comment('是否精华'),
            'user_id' => $this->integer()->notNull()->defaultValue(0),
            'content' => $this->text()->notNull()->comment('内容'),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
            'published_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        $this->createIndex('{{%news_index_published_at}}', '{{%news}}', 'published_at');

        $this->alterColumn('{{%news}}','uuid','varchar(50) BINARY');
        $this->createIndex('{{%news_index_uuid}}', '{{%news}}', 'uuid');
    }

    public function down()
    {
        $this->dropTable('{{%news}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171009101011Create_news_table cannot be reverted.\n";

        return false;
    }
    */
}
