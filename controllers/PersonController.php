<?php

namespace app\controllers;
use app\models\Person;
use yii;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;



class PersonController extends \yii\web\Controller
{
    public function actionHello()
    {
        return $this->render('hello');
    }

    public function actionAdd()
    {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pre', 'id' => $model->id]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
    public function actionPre($id)
    {
        $model = Person::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('pre', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $model = Person::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->delete();
        Yii::$app->session->setFlash('success', 'User deleted successfully.');
        return $this->redirect(['index']); // Redirect to a specific page after deletion
    }

    public function actionList(){
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionEdit($id)
    {
     //does not work for now !!!!!!!!!!!!!!!!!!!!
        $model = Person::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested user does not exist.');
        }
        return $this->redirect(['edit', 'id' => $model->id]);
    }

    public function actionGrid()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('grid',[
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = Person::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['list']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }



}

?>
