<?php

namespace shopium24\mod\plans\migrations;

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190403_052221_plans_options_rel
 */

use panix\engine\db\Migration;
use shopium24\mod\plans\models\Plans;
use shopium24\mod\plans\models\PlansOptions;
use shopium24\mod\plans\models\PlansOptionsRel;

class m190403_052221_plans_options_rel extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(PlansOptionsRel::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'plan_id' => $this->integer()->unsigned()->notNull(),
            'option_id' => $this->integer()->unsigned()->notNull(),
            'value' => $this->text()->null(),
        ], $this->tableOptions);

        $this->createIndex('plan_id', PlansOptionsRel::tableName(), 'plan_id', 0);
        $this->createIndex('option_id', PlansOptionsRel::tableName(), 'option_id', 0);

        $this->addForeignKey('{{fk_plans_options_rel}}', PlansOptionsRel::tableName(), 'plan_id', Plans::tableName(), 'id');
        $this->addForeignKey('{{fk_plans_options_rel_opt}}', PlansOptionsRel::tableName(), 'option_id', PlansOptions::tableName(), 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(PlansOptionsRel::tableName());
        return false;
    }

}
