<?php

namespace shopium24\mod\plans;

use Yii;
use panix\engine\WebModule;
use panix\engine\Html;

class Module extends WebModule
{


    public $icon = 'test';
    public function afterInstall2()
    {
        Yii::$app->database->import($this->id);
        return parent::afterInstall();
    }

    public function afterUninstall2()
    {
        $db = Yii::$app->db;
        $db->createCommand()->dropTable(Plans::model()->tableName());
        $db->createCommand()->dropTable(PlansOptions::model()->tableName());
        $db->createCommand()->dropTable(PlansOptionsGroups::model()->tableName());
        $db->createCommand()->dropTable(PlansOptionsRel::model()->tableName());
        return parent::afterUninstall();
    }

    public function getRules()
    {
        return array(
            'plans' => 'plans/default/index',
        );
    }

    public function getAdminMenu()
    {
        //$c = Yii::app()->controller->module->id;
        return array(
            'plans' => array(
                'label' => $this->name,
                'icon' => Html::icon($this->icon),
                'items' => array(
                    array(
                        'label' => $this->name,
                        'url' => array('/admin/plans/default'),
                        //'active' => ($c == 'plans') ? true : false,
                        'icon' => Html::icon('percent')
                    ),
                    array(
                        'label' => Yii::t('plans/default', 'OPTIONS'),
                        'url' => array('/admin/plans/options'),
                        //'active' => ($c == 'options') ? true : false,
                        'icon' => Html::icon('percent')
                    ),
                    array(
                        'label' => Yii::t('plans/default', 'OPTIONS_GROUP'),
                        'url' => array('/admin/plans/groups'),
                        //'active' => ($c == 'groups') ? true : false,
                        'icon' => Html::icon('percent')
                    ),
                ),
            ),
        );
    }

    public function getAdminSidebarMenu()
    {

        $mod = new EngineMainMenu();
        $items = $mod->findMenu($this->id);
        return $items['items'];
    }

}
