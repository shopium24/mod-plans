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

    public function getGridColumns22()
    {
        return array(
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'Html::link(Html::encode($data->name), array("/admin/plans/default/update", "id"=>$data->id))',
            ),
            array(
                'name' => 'price',
                'type' => 'raw',
                'value' => '$data->price',
            ),

            'DEFAULT_CONTROL' => array(
                'class' => 'ButtonColumn',
                'template' => '{update}{delete}',
            ),
            'DEFAULT_COLUMNS' => array(
                array('class' => 'CheckBoxColumn')
            ),
        );
    }


    public function getOptionsList2()
    {
        return $this->hasMany(PlansOptionsRel::class, ['plan_id' => 'id']);
    }

    public function getOptionsList()
    {
        return $this->hasMany(PlansOptions::class, ['plan_id' => 'id']);
    }
    public function getForm22()
    {
        Yii::import('zii.widgets.jui.CJuiDatePicker');
        return array(
            'attributes' => array(
                'id' => __CLASS__,
                'class' => 'form-horizontal',
            ),
            'showErrorSummary' => true,
            'elements' => array(
                'content' => array(
                    'type' => 'form',
                    'title' => Yii::t('plans/admin', 'Общая информация'),
                    'elements' => array(
                        'name' => array(
                            'type' => 'text',
                        ),
                        'price' => array(
                            'type' => 'text',
                        ),

                    ),
                ),
            ),
            'buttons' => array(
                'submit' => array(
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'label' => ($this->isNewRecord) ? Yii::t('app', 'CREATE', 0) : Yii::t('app', 'CREATE', 1)
                )
            )
        );
    }

    /*
      public function getForm() {
      Yii::import('zii.widgets.jui.CJuiDatePicker');
      return new CMSForm(array(
      'id' => __CLASS__,
      'elements' => array(
      'name' => array(
      'type' => 'text',
      ),
      'switch' => array(
      'type' => 'checkbox',
      ),
      'sum' => array(
      'type' => 'text',
      'hint' => $this->t('HINT_SUM'),
      ),
      'start_date' => array(
      'type' => 'CJuiDatePicker',
      'options' => array(
      'dateFormat' => 'yy-mm-dd ' . date('H:i:s'),
      ),
      ),
      'end_date' => array(
      'type' => 'CJuiDatePicker',
      'options' => array(
      'dateFormat' => 'yy-mm-dd ' . date('H:i:s'),
      ),
      ),
      'manufacturers' => array(
      'type' => 'dropdownlist',
      'items' => CHtml::listData(ShopManufacturer::model()->orderByName()->findAll(), 'id', 'name'),
      'multiple' => 'multiple',
      'data-placeholder' => $this->t('HINT_MANUFACTURERS'),
      ),
      'userRoles' => array(
      'type' => 'dropdownlist',
      'items' => DiscountHelper::getRoles(),
      'multiple' => 'multiple',
      'hint' => $this->t('HINT_USER_ROLES'),
      ),
      ),
      'buttons' => array(
      'submit' => array(
      'type' => 'submit',
      'class' => 'buttonS bGreen',
      'label' => ($this->isNewRecord) ? Yii::t('app', 'CREATE', 0) : Yii::t('app', 'SAVE')
      )
      ),
      ),$this);
      }
     */

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
