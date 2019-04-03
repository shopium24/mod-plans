<?php
namespace shopimu24\mod\plans\migrations;
/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190403_051453_plans_options
 */

use panix\engine\db\Migration;
use shopimu24\mod\plans\models\PlansOptions;

class m190403_051453_plans_options extends Migration {

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


        $this->batchInsert(PlansOptions::tableName(), ['group_id', 'name', 'hint', 'ordern'], [
            [1, 'Возможность сайта на своём домене', '', 14],
            [2, 'Количество товаров', '', 18],
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
