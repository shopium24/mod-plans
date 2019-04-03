<?php
use shopium24\mod\plans\models\PlansOptions;
use panix\engine\Html;

?>
<?php
$check = array();
if ($model->optionsList2) {

    foreach ($model->optionsList2 as $t) {
        $check[$t->option_id]['check'] = true;
        $check[$t->option_id]['value'] = $t->value;


    }
} else {
    $check[0]['check'] = true;
    $check[0]['value'] = null;
}

?>
<?php echo 'Значение 1|0 - отвечает за "доступно/не доступно"';
?>
<table class="table table-striped">
    <?php foreach (PlansOptions::find()->all() as $option) { ?>
        <tr>
            <td> <?= $option->name; ?></td>
            <?php //echo Html::checkBox('options[]',$option->id); ?>

            <td>
                <?php if (isset($check[$option->id])) { ?>
                    <?= Html::textInput('options[' . $option->id . ']', $check[$option->id]['value'], array('class' => 'form-control')); ?>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
