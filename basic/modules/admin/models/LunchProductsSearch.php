<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\LunchProducts;
// use app\modules\admin\models\lunchCategories;

/**
 * lunchProductsSearch represents the model behind the search form about `app\modules\admin\models\lunchProducts`.
 */
class lunchProductsSearch extends lunchProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lunch_category_id', 'order', 'public'], 'integer'],
            [['name', 'description', 'image', 'price', 'weight'], 'safe'],
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
    public function search($params)
    {
        $query = lunchProducts::find()->with('lunchCategory');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lunch_category_id' => $this->lunch_category_id,
            'order' => $this->order,
            'public' => $this->public,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'weight', $this->weight]);

        return $dataProvider;
    }
}
