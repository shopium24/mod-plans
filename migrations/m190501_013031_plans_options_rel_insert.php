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
            [self::PREMIUM, 1, '1'],

            [self::BASIC, 2, '1000'],
            [self::STANDARD, 2, '10000'],
            [self::PREMIUM, 2, 'не ограничено'],

            [self::BASIC, 3, '0'],
            [self::STANDARD, 3, '0'],
            [self::PREMIUM, 3, '1'],

            [self::BASIC, 4, '1'],
            [self::STANDARD, 4, '1'],
            [self::PREMIUM, 4, '1'],

            [self::BASIC, 5, '0'],
            [self::STANDARD, 5, '0'],
            [self::PREMIUM, 5, '1'],

            [self::BASIC, 6, '1'],
            [self::STANDARD, 6, '1'],
            [self::PREMIUM, 6, '1'],

            [self::BASIC, 7, '0'],
            [self::STANDARD, 7, '1'],
            [self::PREMIUM, 7, '1'],

            [self::BASIC, 8, '0'],
            [self::STANDARD, 8, '1'],
            [self::PREMIUM, 8, '1'],

            [self::BASIC, 9, '0'],
            [self::STANDARD, 9, '1'],
            [self::PREMIUM, 9, '1'],

            [self::BASIC, 10, '0'],
            [self::STANDARD, 10, '1'],
            [self::PREMIUM, 10, '1'],

            [self::BASIC, 11, '0'],
            [self::STANDARD, 11, '1'],
            [self::PREMIUM, 11, '1'],

            [self::BASIC, 12, '1'],
            [self::STANDARD, 12, '1'],
            [self::PREMIUM, 12, '1'],

            [self::BASIC, 13, '1'],
            [self::STANDARD, 13, '1'],
            [self::PREMIUM, 13, '1'],

            [self::BASIC, 14, '1'],
            [self::STANDARD, 14, '1'],
            [self::PREMIUM, 14, '1'],

            [self::BASIC, 15, '1'],
            [self::STANDARD, 15, '1'],
            [self::PREMIUM, 15, '1'],

            [self::BASIC, 16, '500 Мб'],
            [self::STANDARD, 16, '1 Гб'],
            [self::PREMIUM, 16, '2 Гб'],

            [self::BASIC, 17, '1 шт.'],
            [self::STANDARD, 17, 'до 3 шт.'],
            [self::PREMIUM, 17, 'до 10 шт.'],

            [self::BASIC, 18, '0'],
            [self::STANDARD, 18, '1'],
            [self::PREMIUM, 18, '1'],

            [self::BASIC, 19, '1'],
            [self::STANDARD, 19, '1'],
            [self::PREMIUM, 19, '1']
        ]);


    }

    public function down()
    {
        $this->truncateTable(PlansOptionsRel::tableName());
    }

    private function getList()
    {
        return [
            self::BASIC => [

            ]
        ];
    }

}
