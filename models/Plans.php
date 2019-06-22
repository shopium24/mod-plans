<?php

namespace shopium24\mod\plans\models;

use panix\engine\db\ActiveRecord;

class Plans extends ActiveRecord
{

    const MODULE_ID = 'plans';

    public $options;

    public function afterSave($insert, $changedAttributes)
    {
        $dontDelete = array();

        foreach ($_POST['options'] as $id => $value) {
            /*$find = PlansOptionsRel::find()->findByAttributes(array(
                'option_id' => (int)c,
                'plan_id' => $this->id
            ));*/


            $find = PlansOptionsRel::find()->where(array(
                'option_id' => $id,
                'plan_id' => $this->id,
            ))->one();

            if (!$find) {
                $record = new PlansOptionsRel;
                $record->option_id = (int)$id;
                $record->plan_id = $this->id;
                $record->value = $value;
                $record->save(false);

            } else {

                // $find = new PlansOptionsRel;
                $find->option_id = (int)$id;
                $find->plan_id = $this->id;
                $find->value = $value;
                $find->save(false);

                $dontDelete[] = $id;
            }
        }


        if (sizeof($dontDelete) > 0) {
            PlansOptionsRel::deleteAll(
                ['AND', 'plan_id=:id', ['NOT IN', 'option_id', $dontDelete]], [':id' => $this->id]);
        } else {
            // Delete all relations
            PlansOptionsRel::deleteAll('plan_id=:id', [':id' => $this->id]);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function setOptions(array $categories)
    {
        $dontDelete = array();

        foreach ($categories as $id => $value) {
            $count = PlansOptionsRel::model()->countByAttributes(array(
                'option_id' => $id,
                'plan_id' => $this->id,
            ));
            echo $count;
            die;
            if ($count == 0) {
                $record = new PlansOptionsRel;
                $record->option_id = (int)$id;
                $record->plan_id = $this->id;
                $record->value = $value;

                $record->save(false, false, false);
            }

            $dontDelete[] = $id;
        }


        // Delete not used relations
        if (sizeof($dontDelete) > 0) {
            $cr = new CDbCriteria;
            $cr->addNotInCondition('option_id', $dontDelete);

            PlansOptionsRel::model()->deleteAllByAttributes(array(
                'plan_id' => $this->id,
            ), $cr);
        } else {
            // Delete all relations
            PlansOptionsRel::model()->deleteAllByAttributes(array(
                'plan_id' => $this->id,
            ));
        }
    }


    public function getOptionsList2()
    {
        return $this->hasMany(PlansOptionsRel::class, ['plan_id' => 'id']);
    }

    public function getOptionsList()
    {
        return $this->hasMany(PlansOptions::class, ['plan_id' => 'id']);
    }






    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plans}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['name', 'price_month','price_6month','price_year'], 'required'],
           // ['id, name, price', 'safe', 'on' => 'search'],
        ];
    }


}
