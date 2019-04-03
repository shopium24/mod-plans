<?php
namespace shopium24\mod\plans\migrations;
/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190403_050923_plans
 */

use panix\engine\db\Migration;
use shopium24\mod\plans\models\Plans;

class m190403_050923_plans extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(Plans::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'price_month' => $this->money(10, 2),
            'price_6month' => $this->money(10, 2),
            'price_year' => $this->money(10, 2),
        ], $this->tableOptions);


        $this->batchInsert(Plans::tableName(), ['name', 'price_month', 'price_6month', 'price_year'], [
            ['Basic', '160', '150', '140'],
            ['Standard', '500', '480', '450'],
            ['Premium', '1000', '950', '900'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(Plans::tableName());
        return false;
    }

}
