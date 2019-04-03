<?php
use panix\engine\Html;
use panix\engine\bootstrap\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use panix\mod\shop\models\ProductType;

$form = ActiveForm::begin([
    'id' => strtolower(basename(get_class($model))) . '-form',
]);


$tabs = [];


$tabs[] = [
    'label' => $model::t('TAB_MAIN'),
    'content' => $this->render('_main', ['form' => $form, 'model' => $model]),
    'active' => true,
    'options' => ['class'=>'flex-sm-fill text-center nav-item'],
];

$tabs[] = [
    'label' => $model::t('TAB_OPTIONS'),
    'content' => $this->render('_options', ['form' => $form,'model' => $model]),
    'options' => ['class'=>'flex-sm-fill text-center nav-item'],
];


echo \panix\engine\bootstrap\Tabs::widget([
    //'encodeLabels'=>true,
    'options' => [
        'class' => 'nav-pills flex-column flex-sm-row nav-tabs-static'
    ],
    'items' => $tabs,
]);
?>
    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


<?php
ActiveForm::end();

?>