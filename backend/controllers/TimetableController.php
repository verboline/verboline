<?php

namespace backend\controllers;

use Yii;
use common\models\Timetable;
use common\models\TimetableInitForm;
use common\models\TimetableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TeacherCourse;
/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Timetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->searchWithRelations(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Timetable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

 
    public function actionCreate()
    {
        $model = new TimetableInitForm();
        
        if ($model->load(Yii::$app->request->post())&&($model->makeTimeTable())) {
                return $this->redirect(['timetable/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
               // 'courseInstanse' => $courseInstanse
            ]);
        }
    }

    /**
     * Updates an existing Timetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Timetable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCalendar()
    {   
        $lessons = Timetable::find()->all();
        foreach ($lessons as $lesson) {
            $json[] = ['id'=>$lesson->id,'start_date' => $lesson->start, 'end_date' => $lesson->start, 'text' => $lesson->lesson->title];
        }
        return json_encode($json);
        //return '[{id:1,text:"Meeting",start_date:"07/11/2014 14:00",end_date:"07/11/2014 17:00"}]';
    }
    
    public function actionUpdateLesson()
    {  
        $response = '';
        $params = Yii::$app->request->post();
        $ids = split(',', $params['ids']);
        foreach ($ids as $id) {
            $operation =  $params[$id.'_!nativeeditor_status'];
            switch ($operation) {
                case 'inserted':
                    $model = new Timetable;
                    $model->start = $params[$id.'_start_date'];
                    $model->finish = $params[$id.'_end_date'];
                    $model->description = $params[$id.'_text'];
                    if ($model->save()) {
                        $response.='<action type="'.$operation.'" sid="'.$model->id.'" tid="'.$model->id.'" />';
                    }
                    else {
                        $response.='<action type="'.'error'.'" sid="'.$model->id.'" tid="'.$model->id.'" >'.implode(' ',$model->getFirstErrors()).'</action>';
                    }
                    break;
                case 'deleted':
                    $model = Timetable::findOne($params[$id.'_id']);
                    if ($model->delete()) {
                        $response.='<action type="'.$operation.'" sid="'.$model->id.'" tid="'.$model->id.'" />';
                    }
                    else {
                        $response.='<action type="'.'error'.'" sid="'.$model->id.'" tid="'.$model->id.'" >'.implode(' ',$model->getFirstErrors()).'</action>';
                    }
                    break;
                case 'updated':
                    $model = Timetable::findOne($params[$id.'_id']);
                    $model->start = $params[$id.'_start_date'];
                    $model->finish = $params[$id.'_end_date'];
                    $model->description = $params[$id.'_text'];
                    if ($model->save()) {
                        $response.='<action type="'.$operation.'" sid="'.$model->id.'" tid="'.$model->id.'" />';
                    }
                    else {
                        $response.='<action type="'.'error'.'" sid="'.$model->id.'" tid="'.$model->id.'" >'.implode(' ',$model->getFirstErrors()).'</action>';
                    }
                    break;
            }
            
           
        }
        
        header('Content-Type: text/xml');
        echo '<data>'.
                $response.
            '</data>';
        return; 
    }
}
