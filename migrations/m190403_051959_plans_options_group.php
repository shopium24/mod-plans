<?php
namespace shopimu24\mod\plans\migrations;

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190403_051959_plans_options_group
 */

use panix\engine\db\Migration;
use shopimu24\mod\plans\models\PlansOptionsGroups;

class m190403_051959_plans_options_group extends Migration {

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(PlansOptionsGroups::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'hint' => $this->text()->null(),
            'ordern' => $this->integer()->unsigned(),
        ], $this->tableOptions);


        $this->batchInsert(PlansOptionsGroups::tableName(), ['name', 'ordern'], [
            ['Основные возможности', '', 1],
            ['Товар', '', 2],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(PlansOptionsGroups::tableName());
        return false;
    }

}
