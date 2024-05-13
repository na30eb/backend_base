<?php

namespace app\controllers;

use app\models\AddModel;
use app\models\Brand;
use app\models\Cardetail;
use app\models\CarModel;
use app\models\Customer;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
class SellController extends Controller{

    public function actionIndex()
    {
        $cars=new Cardetail();
        $list=Cardetail::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index',[
            'dataProvider'=>$dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $carDetail=new Cardetail();
        $carmodel=new CarModel();
        $options = CarModel::find()->all();
        $modeldropdownOptions = [];
        foreach ($options as $option) {
            //find the id of brands and use them as an index and then save their name in the sam eindex
            $modeldropdownOptions[$option->id] = $option->id;
        }
        if ($carDetail->load(Yii::$app->request->post())) {
            $carid = Yii::$app->request->post('CarModel')['id'];
            $search = CarModel::findOne(['id' => $carid]);
            if ($search) {
                $carDetail->id_car = $carid; // Assign the selected car's ID
                if ($carDetail->save()) {
                    // Redirect to the index action
                    return $this->redirect(['index']);
                } else {
                    // Log or display errors
                    Yii::error('Model not saved: ' . print_r($carDetail->errors, true));
                    Yii::$app->session->setFlash('error', 'Failed to save model.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Selected car does not exist.');
            }
        }
        return $this->render('create',[
            'carDetail'=>$carDetail,
            'carmodel'=>$carmodel,
            'modeldropdownOptions'=>$modeldropdownOptions,

        ]);

    }
    public function actionUpdate($id)
    {
        $carmodel=new CarModel();
        $carDetail=new Cardetail();
        $options = CarModel::find()->all();
        $modeldropdownOptions = [];
        foreach ($options as $option) {
            //find the id of brands and use them as an index and then save their name in the sam eindex
            $modeldropdownOptions[$option->id] = $option->id;
        }
        $selected = Cardetail::findOne($id);
        if ($selected->load(Yii::$app->request->post()) && $selected->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'selected' => $selected,
            'carDetail'=>$carDetail,
            'carmodel'=>$carmodel,
            'modeldropdownOptions'=>$modeldropdownOptions,
        ]);

    }
    public function actionDelete($id)
    {
        $sleceted = Cardetail::findOne($id);
        if (!$sleceted) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $sleceted->delete();
        Yii::$app->session->setFlash('success', 'User deleted successfully.');
        return $this->redirect(['index']); // Redirect to a specific page after deletion
    }


}