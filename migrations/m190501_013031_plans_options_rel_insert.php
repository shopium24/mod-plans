<?php

namespace shopium24\mod\plans\migrations;

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m190501_013031_plans_options_rel_insert
 */

use panix\engine\db\Migration;
use shopium24\mod\plans\models\PlansOptionsRel;

class m190501_013031_plans_options_rel_insert extends Migration
{
    const BASIC = 1;
    const STANDARD = 2;
    const PREMIUM = 3;

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->batchInsert(PlansOptionsRel::tableName(), ['plan_id', 'option_id', 'value'], [
            [self::BASIC, 1, '1'],
            [self::STANDARD, 1, '1'],
            [self::PREMIUM, 1, '0'],
        ]);

        $this->batchInsert(PlansOptionsRel::tableName(), ['plan_id', 'option_id', 'value'], [
            ['3', '3', '1'],
            ['2', '3', '0'],
            ['1', '12', '1'],
            ['3', '2', 'не ограничено'],
            ['2', '2', '10000'],
            ['1', '11', '0'],
            ['3', '1', '1'],
            ['2', '1', '1'],
            ['1', '1', '1'],
            ['2', '4', '1'],
            ['3', '4', '1'],
            ['1', '10', '0'],
            ['2', '5', '0'],
            ['3', '5', '1'],
            ['1', '9', '0'],
            ['2', '6', '1'],
            ['3', '6', '1'],
            ['1', '8', '0'],
            ['2', '7', '1'],
            ['3', '7', '1'],
            ['1', '7', '0'],
            ['2', '8', '1'],
            ['3', '8', '1'],
            ['1', '6', '1'],
            ['2', '9', '1'],
            ['3', '9', '1'],
            ['1', '5', '0'],
            ['2', '10', '1'],
            ['3', '10', '1'],
            ['1', '4', '1'],
            ['2', '11', '1'],
            ['3', '11', '1'],
            ['1', '3', '0'],
            ['2', '12', '1'],
            ['3', '12', '1'],
            ['1', '2', '1000'],
            ['2', '13', '1'],
            ['3', '13', '1'],
            ['2', '14', '1'],
            ['3', '14', '1'],
            ['1', '14', '1'],
            ['1', '13', '1'],
            ['1', '15', '1'],
            ['2', '15', '1'],
            ['3', '15', '1'],
            ['1', '16', '500 Мб'],
            ['2', '16', '1 Гб'],
            ['3', '16', '2 Гб'],
            ['1', '17', 'до 3 шт.'],
            ['2', '17', 'до 5 шт.'],
            ['3', '17', 'до 10 шт.'],
            ['1', '18', '0'],
            ['2', '18', '1'],
            ['3', '18', '1'],
            ['1', '19', '1'],
            ['2', '19', '1'],
            ['3', '19', '1']
        ]);


    }

    public function down()
    {
        echo "m190501_013031_plans_options_rel_insert cannot be reverted.\n";
        $this->truncateTable(PlansOptionsRel::tableName());
        return false;
    }

    private function getList()
    {
        return [
            self::BASIC => [

            ]
        ];
    }

}
