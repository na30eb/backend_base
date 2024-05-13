<?php

namespace app\controllers;

use app\models\AddModel;
use app\models\Brand;
use app\models\CarModel;
use app\models\jointest;
use app\models\Person;
use app\models\Test1;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\db\ActiveRecord;
use antkaz\ajax;
use yii\web\Response;

class CarController extends Controller
{
    public function actionBrand2()
    {
        $brand=new Brand();

        $result = (new \yii\db\Query())
            ->select('brands.id_brand, brands.name AS brand_name, models.id_model, models.name AS model_name')
            ->from('brands')
            ->innerJoin('models', 'brands.id_brand = models.id_brand')
            ->all();


        return $this->render('brand2', ['result' => $result,
            'brand' => $brand]);

    }//end of function

    public function actionAddbrand()
    {
        //accessing model
        $brandModel = new Brand();
        //if model has been loaded successfully
        if ($brandModel->load(Yii::$app->request->post()) && $brandModel->save()) {
            //if=>true => showing message with setFlash
            Yii::$app->session->setFlash('success', 'Brand added successfully.');
            //if=>true => redicrect to addmodle view and action in below
            return $this->redirect(['addmodle']);
        }
        //if=>false => rerender the addbrand page(current page)
        return $this->render('addbrand', [
            'brandModel' => $brandModel,
        ]);
    }
    public function actionAddmodle()
    {
        //access addModel and Brand model
        $addModel = new AddModel();
        $brandModel = new Brand();//foreign table
        //if addmodel has been loeaded successfully
        if ($addModel->load(Yii::$app->request->post())) {
            // Get the selected brand name from the form data and save it in a variable
            $brandName = Yii::$app->request->post('Brand')['name'];
            // Find the corresponding Brand model based on the selected name =>we finally have the name of all brands
            $brand = Brand::findOne(['id_brand' => $brandName]);
            //if we truly have the name of all the brands
            if ($brand) {
                //if=>true =>check if the slected brand id in model table does exist in brand table
                $addModel->id_brand = $brand->id_brand;
                //save the data with addmodel model in inside the dab table model
                if ($addModel->save()) {
                    //if =>saved =>then redirect to the show page and pass the id also
                    return $this->redirect(['modelspre', 'id' => $addModel->id_model]);
                } else {
                    // if not saved then show the errors
                    Yii::error('Model not saved: ' . print_r($addModel->errors, true));
                    // Provide feedback to the user about the error and show a message with setFlash from session component
                    Yii::$app->session->setFlash('error', 'Failed to save model.');
                }
            } else {
                // if the selected brand does not exist in the brand table tehn show an error with set flash from session
                // Handle case when brand doesn't exist
                Yii::$app->session->setFlash('error', 'Selected brand does not exist.');
            }
        }

        // Fetch options for the dropdown menu
        //get everything from brand table
        $options = Brand::find()->all();
        $dropdownOptions = []; //create an array for displaying and craetion of all option of drop down menu
        foreach ($options as $option) {
            //find the id of brands and use them as an index and then save their name in the sam eindex
            $dropdownOptions[$option->id_brand] = $option->name;
        }
            // render the new view and pass down the data
        return $this->render('addmodle', [
            'addModel' => $addModel, // the model for adding data to models table
            'brandModel' => $brandModel, //the brand model for getting all of the options of drop down menu
            'dropdownOptions' => $dropdownOptions, // the drop down menu options
        ]);
    }


    public function actionModelspre($id)
    {


        //access to all of the models of the table
        $brandModel = new Brand();
        $addModel = new AddModel();
        $carmodel = new CarModel();

        $car= \app\models\CarModel::find()
            ->joinWith(['brand','model']);

        $dataProvider = new ActiveDataProvider([
            'query' => $car,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        if ($carmodel->load(Yii::$app->request->post())) {
            // Get the selected brand name from the form data and save it in a variable
            $brandName = Yii::$app->request->post('Brand')['id_brand'];
            // Find the corresponding Brand model based on the selected name =>we finally have the name of all brands
            $brand = Brand::findOne(['id_brand' => $brandName]);

            $modelName = Yii::$app->request->post('AddModel')['id_model'];

            // Find the corresponding Brand model based on the selected name =>we finally have the name of all brands
            $model = AddModel::findOne(['id_model' => $modelName]);
            //if we truly have the name of all the brands
            if ($brand && $model) {
                //if=>true =>check if the slected brand id in model table does exist in brand table
                $carmodel->id_brand = $brand->id_brand;
                $carmodel->id_model= $model->id_model;
                if ($carmodel->save()) {
                    //if =>saved =>then redirect to the show page and pass the id also
                    return $this->render('result', [
                        'dataProvider' => $dataProvider,
                    ]);
                } else {
                    // if not saved then show the errors
                    Yii::error('Model not saved: ' . print_r($addModel->errors, true));
                    // Provide feedback to the user about the error and show a message with setFlash from session component
                    Yii::$app->session->setFlash('error', 'Failed to save model.');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Selected brand or model does not exist.');
            }
        }

        // Find all AddModel records with the given $id_model
        $getmodelID = AddModel::findAll(['id_model' => $id]);

    // Initialize an array to store the id_brand values
        $getbrandid = [];

    // Iterate over each AddModel object and extract the id_brand value
        foreach ($getmodelID as $ids) {
            $getbrandid[] = $ids->id_brand;
        }

    // Find all AddModel records with the id_brand values obtained
        $showbrand = AddModel::findAll(['id_brand' => $getbrandid]);


        if (!$getmodelID) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $showbrand,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        //brand drop down menu
        $options = Brand::find()->all();
        $dropdownOptions = []; //create an array for displaying and craetion of all option of drop down menu
        foreach ($options as $option) {
            //find the id of brands and use them as an index and then save their name in the sam eindex
            $dropdownOptions[$option->id_brand] = $option->name;
        }
        //model drop down options
        $options = AddModel::find()->all();
        $modeldropdownOptions = []; //create an array for displaying and craetion of all option of drop down menu
        foreach ($options as $option) {
            //find the id of brands and use them as an index and then save their name in the sam eindex
            $modeldropdownOptions[$option->id_model] = $option->name;
        }

        return $this->render('modelspre', [
            'getmodelID' => $getmodelID,
            'showbrand' => $showbrand,
            'brandModel'=>$brandModel,
            'addModel'=>$addModel,
            'dropdownOptions' => $dropdownOptions,
            'modeldropdownOptions'=>$modeldropdownOptions,
            'carmodel'=>$carmodel,
        ]);
    }
    public function actionResult()
    {
        $car= \app\models\CarModel::find()
            ->joinWith(['brand','model']);

        $dataProvider = new ActiveDataProvider([
            'query' => $car,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('result', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionGet($brandId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        // Fetch models based on the selected brand ID
        $models = AddModel::find()->where(['id_brand' => $brandId])->all();

        // Format models data as needed
        $formattedModels = [];
        foreach ($models as $model) {
            $formattedModels[] = [
                'id' => $model->id_model,
                'name' => $model->name,
                // Add more fields as needed
            ];
        }

        // Return models data as JSON response
        return $formattedModels;

    }

}


?>