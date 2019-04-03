<?php

namespace shopium24\mod\plans\controllers\admin;

use shopium24\mod\plans\models\PlansOptions;
use shopium24\mod\plans\models\search\PlansOptionsSearch;
use Yii;
use panix\engine\controllers\AdminController;

class OptionsController extends AdminController
{

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'ext.adminList.actions.DeleteAction',
            ),
            'sortable' => array(
                'class' => 'ext.sortable.SortableAction',
                'model' => PlansOptions::find(),
            )
        );
    }

    /**
     * Display discounts list
     */
    public function actionIndex()
    {

        $this->pageName = Yii::t('plans/default', 'OPTIONS');
        /* $this->breadcrumbs = array(
             $this->module->name => [],
             $this->pageName
         );*/
        $this->breadcrumbs[] = $this->pageName;
        $searchModel = new PlansOptionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Create new discount
     */
    //public function actionCreate() {
    //    $this->actionUpdate(true);
    // }

    /**
     * Update discount
     * @param bool $new
     * @throws CHttpException
     */
    public function actionUpdate($new = false)
    {
        if ($new === true)
            $model = new PlansOptions;
        else
            $model = PlansOptions::model()->findByPk($_GET['id']);

        if (!$model)
            throw new CHttpException(404, Yii::t('plans/admin', 'NO_FOUND_DISCOUNT'));

        $this->pageName = ($model->isNewRecord) ? Yii::t('plans/admin', 'Создание опции') :
            Yii::t('plans/admin', 'Редактирование опции');


        $this->breadcrumbs = array(
            $this->module->name => $this->module->adminHomeUrl,
            Yii::t('plans/default', 'OPTIONS') => $this->createUrl('index'),
            $this->pageName
        );


        $form = new TabForm($model->getForm(), $model);
        $form->additionalTabs[Yii::t('plans/admin', 'Options')] = array('content' => $this->renderPartial('_options', array('model' => $model), true));

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getPost('PlansOptions');
            if ($model->validate()) {
                $model->save();
                $this->saveOptions($model);
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array('model' => $model, 'form' => $form));
    }

    public function saveOptions(PlansOptions $planOption)
    {
        $dontDelete = array();
        if (isset($_POST['options'])) {
            // print_r($_POST['options']);
            //  die;
            foreach ($_POST['options'] as $key => $value) {

                $productOptions = PlansOptionsRel::model()->findByAttributes(array(
                    'plan_id' => $key,
                    'option_id' => $planOption->id,
                ));

                if (!$productOptions)
                    $productOptions = new PlansOptionsRel();


                $productOptions->setAttributes(array(
                    'option_id' => $planOption->id,
                    'plan_id' => $key,
                    'value' => $value,
                ), false);
                //$productOptions->name = $option['name'];

                $productOptions->save(false, false, false);

                array_push($dontDelete, $productOptions->id);
            }
        }

        if (sizeof($dontDelete)) {
            $cr = new CDbCriteria;
            $cr->addNotInCondition('t.id', $dontDelete);
            $optionsToDelete = PlansOptionsRel::model()->findAllByAttributes(array(
                'option_id' => $planOption->id
            ), $cr);
        } else {
            // Clear all attribute options
            $optionsToDelete = PlansOptionsRel::model()->findAllByAttributes(array(
                'option_id' => $planOption->id
            ));
        }
        if (!empty($optionsToDelete)) {
            foreach ($optionsToDelete as $o)
                $o->delete();
        }
    }

}