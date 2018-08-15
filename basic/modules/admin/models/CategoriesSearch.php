<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `app\modules\admin\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'order_num'], 'integer'],
            [['name', 'description', 'public', 'meta_key', 'class', 'image', 'back_image', 'public_in_menu', 'public_in_cat'], 'safe'],
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
        $query = Categories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->with('category')->orderBy('order_num'),
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
            'parent_id' => $this->parent_id,
            'public' => $this->public,
            'order_num' => $this->order_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_key', $this->meta_key])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'back_image', $this->back_image])
            ->andFilterWhere(['like', 'public_in_menu', $this->public_in_menu])
            ->andFilterWhere(['like', 'public_in_cat', $this->public_in_cat]);

        return $dataProvider;
    }
}
