<?php
use panix\engine\grid\GridView;
use panix\engine\widgets\Pjax;


Pjax::begin([
    'timeout' => 50000,
    'id' => 'pjax-grid-plans',
    'linkSelector' => 'a:not(.linkTarget)'
]);
echo GridView::widget([
    'id'=>'grid-plans',
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layoutOptions' => [
        'title' => $this->context->pageName,
        'buttons'=>[
            [
                'url'=>['create'],
                'label'=>Yii::t('plans/admin', 'CREATE_PRODUCT'),
                'icon'=>'add'
            ]
        ]
    ],
    'showFooter' => true,
    //   'footerRowOptions' => ['class' => 'text-center'],
    'rowOptions' => ['class' => 'sortable-column']
]);
Pjax::end();

