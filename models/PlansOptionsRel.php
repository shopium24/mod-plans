<?php

namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;

class PlansOptionsRel extends ActiveRecord
{

    const MODULE_ID = 'plans';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plans_option_rel}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['plan_id', 'required'],
        ];
    }


}