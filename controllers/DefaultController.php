<?php

namespace shopium24\mod\plans\controllers;

use panix\engine\controllers\WebController;
use Yii;

class DefaultController extends WebController
{


    public function actionIndex($category = null)
    {


        $this->pageName = Yii::t('plans/default', 'MODULE_NAME');
        $this->breadcrumbs = array($this->pageName);


       return $this->render('index', []);
    }


}
