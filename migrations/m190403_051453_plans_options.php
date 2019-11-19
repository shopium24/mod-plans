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
            ['1', 'Возможность сайта на своём домене ', '', '14'],
            ['2', 'Количество товаров', '', '18'],
            ['1', 'SMS рассылка', '', '1'],
            ['1', 'Email рассылка', '', '9'],
            ['1', 'Интеграция с 1С:Предприятие', '', '2'],
            ['1', 'Поддержка 24/7 ', 'Поддержка производится по системе тикет', '12'],
            ['1', 'Система скидок / наценок', '', '6'],
            ['1', 'Экспорт в Яндекс.Маркет ', '', '7'],
            ['1', 'sitemap.xml ', '', '5'],
            ['1', 'Рейтинг товаров ', '', '4'],
            ['1', 'Отзывы о товаре ', '', '3'],
            ['1', 'Импорт/экспорт товаров *.csv', '', '10'],
            ['1', 'Импорт/экспорт товаров *.xml', '', '11'],
            ['1', 'Статистика продаж (график)', '', '13'],
            ['1', 'Адаптивный стартовый шаблон', 'Целью адаптивного веб-дизайна является универсальность отображения содержимого веб-сайта для различных устройств. Для того, чтобы веб-сайт был удобно просматриваемым с устройств форматов и с экранами различных разрешений, по технологии адаптивного веб-дизайна не нужно создавать отдельные версии веб-сайта для отдельных видов устройств. Один сайт может работать на смартфоне, планшете, ноутбуке и телевизоре с выходом в интернет, то есть на всем спектре устройств
&copy <strong>wikipedia</strong>', '16'],
            ['1', 'Место на диске', 'Дисковое пространство на сервере, которое предназначено для файлов сайта.', '17'],
            ['2', 'Изображений в товаре', '', '19'],
            ['1', 'Сравнение товаров', '', '8'],
            ['1', 'Список желаний', '', '15']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(PlansOptions::tableName());
    }

}
