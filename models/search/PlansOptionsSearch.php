<?php

namespace shopium24\mod\plans\models\search;

use Yii;
use yii\base\Model;
use panix\engine\data\ActiveDataProvider;
use shopium24\mod\plans\models\PlansOptions;

/**
 * ProductSearch represents the model behind the search form about `shopium24\mod\plans\models\PlansOptions`.
 */
class PlansOptionsSearch extends PlansOptions
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            //[['price_min', 'price_max'], 'integer'],
            // [['image'],'boolean'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params=array())
    {
        $query = PlansOptions::find();
        //$query->joinWith('translations');
        //$query->sort();
      //  $query->joinWith(['translations translations']);



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => self::getSort()
            'sort' => [
                //'defaultOrder' => ['date_create' => SORT_ASC],
                'attributes' => [
                    'name',
                ],
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'translations.name', $this->name]);





        return $dataProvider;
    }



}
