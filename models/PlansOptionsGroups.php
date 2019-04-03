<?php
namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;
class PlansOptionsGroups extends ActiveRecord {

    const MODULE_ID = 'plans';

    public function getGridColumns2() {
        return array(
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'Html::link(Html::encode($data->name), array("/admin/plans/groups/update", "id"=>$data->id))',
            ),
            'DEFAULT_CONTROL' => array(
                'class' => 'ButtonColumn',
                'template' => '{update}{delete}',
            ),
            'DEFAULT_COLUMNS' => array(
                array('class' => 'ext.sortable.SortableColumn')
            ),
        );
    }

    public function getOptions()
    {
        return $this->hasMany(PlansOptions::class, ['group_id' => 'id']);
    }


    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%plans_options_groups}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name', 'type'], 'type' => 'string'],
        ];
    }

    public static function getCSort() {
        $sort = new CSort;
        $sort->defaultOrder = 'ordern DESC';


        return $sort;
    }


}
