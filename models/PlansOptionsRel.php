<?php
namespace shopimu24\mod\plans\models;

use panix\engine\db\ActiveRecord;
class PlansOptionsRel extends ActiveRecord {

    const MODULE_ID = 'plans';


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%plans_option_rel}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('plan_id', 'required'),
            array('id, plan_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return ActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);

        return new ActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}