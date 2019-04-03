<?php

namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;

class PlansOptionsRel extends ActiveRecord
{

    const MODULE_ID = 'plans';


    /**
     * @return string the associated database table name
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
        return array(
            array('plan_id', 'required'),
            array('id, plan_id', 'safe', 'on' => 'search'),
        );
    }


}