<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Timetable;

/**
 * TimetableSearch represents the model behind the search form about `common\models\Timetable`.
 */
class TimetableSearch extends Timetable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lesson_id'], 'integer'],
            [['start', 'finish', 'course_uid'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Timetable::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start' => $this->start,
            'finish' => $this->finish,
            'lesson_id' => $this->lesson_id,
        ]);

        $query->andFilterWhere(['like', 'course_uid', $this->course_uid]);

        return $dataProvider;
    }
    public function searchWithRelations($params)
    {
        $query = Timetable::find()->with('lesson','course','teacher');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start' => $this->start,
            'finish' => $this->finish,
            'lesson_id' => $this->lesson_id,
        ]);

        $query->andFilterWhere(['like', 'course_uid', $this->course_uid]);

        return $dataProvider;
    }
}
