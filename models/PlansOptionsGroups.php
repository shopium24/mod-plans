<?php

namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;

class PlansOptionsGroups extends ActiveRecord
{

    const MODULE_ID = 'plans';



    public function getOptions()
    {
        return $this->hasMany(PlansOptions::class, ['group_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plans_options_groups}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'type'], 'type' => 'string'],
        ];
    }

}
