<?php

namespace shopium24\mod\plans\migrations;

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190403_051453_plans_options
 */

use panix\engine\db\Migration;
use shopium24\mod\plans\models\PlansOptions;
use shopium24\mod\plans\models\PlansOptionsGroups;

class m190403_051453_plans_options extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(PlansOptions::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'group_id' => $this->integer()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'hint' => $this->text()->null(),
            'ordern' => $this->integer()->unsigned(),
        ], $this->tableOptions);

        $this->createIndex('ordern', PlansOptions::tableName(), 'ordern', 0);

        //$this->addForeignKey('{{fk_options_group}}', PlansOptions::tableName(), 'group_id', PlansOptionsGroups::tableName(), 'id');


        $this->batchInsert(PlansOptions::tableName(), ['group_id', 'name', 'hint', 'ordern'], [
            [1, 'Возможность сайта на своём домене', '', 3],
            [2, 'Количество товаров', '', 2],
            [1, 'SMS рассылка', '', 1],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(PlansOptions::tableName());
        return false;
    }

}
