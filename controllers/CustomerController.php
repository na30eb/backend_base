<?php


namespace app\controllers;

use app\models\Customer;
use app\models\Person;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class  CustomerController extends Controller
{
    public function actionIndex()
    {
        $customers = new Customer();
        $listOfAllCustomers = Customer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $listOfAllCustomers,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', ['listOfAllCustomers' => $listOfAllCustomers, 'dataProvider' => $dataProvider , 'customers' => $customers]);
    }
    public function actionCreate()
    {
        $customer = new Customer();
        if($customer->load(Yii::$app->request->post()) && $customer->save()){

            yii::$app->session->setFlash("signed in ");
            return $this->redirect(['index']);

        }else{
            yii::$app->session->setFlash("failed to create customer! please try again! ");
        }
        return $this->render('create', ['customer' => $customer]);

    }
    public function actionUpdate($id)
    {
        $selected = Customer::findOne($id);
        if ($selected->load(Yii::$app->request->post()) && $selected->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'selected' => $selected,
        ]);

    }
    public function actionDelete($id)
    {
        $sleceted = Customer::findOne($id);
        if (!$sleceted) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $sleceted->delete();
        Yii::$app->session->setFlash('success', 'User deleted successfully.');
        return $this->redirect(['index']); // Redirect to a specific page after deletion
    }

}