<?php

namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;
use panix\engine\Html;

class PlansOptions extends ActiveRecord
{

    const MODULE_ID = 'plans';


    public function getRels()
    {
        return $this->hasMany(PlansOptionsRel::class, ['option_id' => 'id']);
    }

    public function getGroup()
    {
        return $this->hasMany(PlansOptionsGroups::class, ['option_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plans_options}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'required'],
            ['hint', 'type', 'type' => 'string'],
        ];
    }


}
