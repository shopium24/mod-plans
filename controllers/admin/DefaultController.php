<?php

namespace shopium24\mod\plans\controllers\admin;

use shopium24\mod\plans\models\Plans;
use shopium24\mod\plans\models\PlansOptionsRel;
use shopium24\mod\plans\models\search\PlansSearch;
use Yii;
use panix\engine\controllers\AdminController;

class DefaultController extends AdminController
{

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'ext.adminList.actions.DeleteAction',
            ),
        );
    }

    /**
     * Display discounts list
     */
    public function actionIndex()
    {
        $this->pageName = Yii::t('plans/default', 'MODULE_NAME');


       // $this->breadcrumbs[] = [
       //     'label' => Yii::t('plans/default', 'MODULE_NAME'),
       //     'url' => ['/admin/shop'],
       // ];
        $this->breadcrumbs[] = $this->pageName;

        $searchModel = new PlansSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }

    /**
     * Update discount
     * @param bool $new
     * @throws CHttpException
     */
    public function actionUpdate($new = false)
    {
        if ($new === true)
            $model = new Plans;
        else
            $model = Plans::findOne($_GET['id']);

        if (!$model)
            $this->error404(Yii::t('plans/admin', 'NO_FOUND_PLAN'));


        $this->pageName = ($model->isNewRecord) ? Yii::t('plans/admin', 'Создание тарифного плана') :
            Yii::t('plans/admin', 'Редактирование плана');

        $this->breadcrumbs[] = [
            'label' => Yii::t('plans/default', 'MODULE_NAME'),
            'url' => ['/admin/shop'],
        ];
        $this->breadcrumbs[] = $this->pageName;


        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {

            if ($model->validate()) {
                //$model->setOptions($_POST['options']);
                $model->save();

                // $this->saveOptions($model);

                //$this->redirect(array('index'));
            } else {
                print_r($model->getErrors());
                die;
            }
        }

        return $this->render('update', array('model' => $model));
    }


    public function saveOptions(Plans $model)
    {
        if (isset($_POST['options'])) {
            foreach ($_POST['options'] as $option_id => $option) {
                $opt = new PlansOptionsRel();
                $opt->plan_id = $model->id;
                $opt->option_id = $option_id;
                $opt->value = $option['value'];
                if ($opt->validate()) {
                    $opt->save(false, false);
                } else {
                    die('error saveOptions()');
                }
            }
        }
    }

}
