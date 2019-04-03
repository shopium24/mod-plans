<?php
$this->widget('ext.adminList.GridView', array(
    'dataProvider' => $model->search(),
    //'afterAjaxUpdate'=>"function(){registerDatePickers()}",
    'filter' => $model,
    'name' => $this->pageName,
));
?>
