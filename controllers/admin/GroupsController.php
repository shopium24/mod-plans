<?php
namespace shopium24\mod\plans\controllers\admin;

use shopium24\mod\plans\models\PlansOptionsGroups;
use shopium24\mod\plans\models\search\PlansOptionsGroupsSearch;
use Yii;
use panix\engine\controllers\AdminController;
class GroupsController extends AdminController {

    public function actions() {
        return array(
            'delete' => array(
                'class' => 'ext.adminList.actions.DeleteAction',
            ),

        );
    }

    /**
     * Display discounts list
     */
    public function actionIndex() {
        $this->pageName = Yii::t('plans/default', 'OPTIONS_GROUP');

        $this->breadcrumbs[]=$this->pageName;

        $searchModel = new PlansOptionsGroupsSearch();
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
    public function actionUpdate($new = false) {
        if ($new === true)
            $model = new PlansOptionsGroups;
        else
            $model = PlansOptionsGroups::model()->findByPk($_GET['id']);

        if (!$model)
            throw new CHttpException(404, Yii::t('plans/admin', 'NO_FOUND_DISCOUNT'));

        $this->pageName = ($model->isNewRecord) ? Yii::t('plans/admin', 'Создание группы') :
                Yii::t('plans/admin', 'Редактирование группы');


        $this->breadcrumbs = array(
            $this->module->name => $this->module->adminHomeUrl,
            Yii::t('plans/default', 'OPTIONS_GROUP') => $this->createUrl('index'),
            $this->pageName
        );

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getPost('PlansOptionsGroups');
            if ($model->validate()) {
                $model->save();
              //  $this->saveOptions($model);
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array('model' => $model));
    }


}