<?php
namespace app\controllers;

use app\models\AddModel;
use app\models\Cardetail;
use app\models\CarModel;
use app\models\Customer;
use app\models\Orders;
use kartik\select2\Select2;
use PHPUnit\Framework\Constraint\Count;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\web\Controller;
use yii\web\Response;
use function Sodium\compare;

class OrderController extends Controller
{
    public function actionIndex(): string
    {
//        $options = Customer::find()->all();
//        $modeldropdownOptions = [];
//        //dropdown menu options
//        foreach ($options as $option) {
//            //find the id of brands and use them as an index and then save their name in the sam index
//            $modeldropdownOptions[$option->id] = $option->name ." ". $option->family." | id= ". $option->id;
//        }
//        return $this->render('index',[
//            'modeldropdownOptions' => $modeldropdownOptions,
//            'options'=>$options,
//        ]);
    }
    public function actionCreate(): string
    {
        //models
        $customer = new Customer();
        $order = new Orders();


        $options = Customer::find()->all();
        $modeldropdownOptions = [];
        //dropdown menu options
        foreach ($options as $option) {
            $id = $option->id;
            $name = $option->name;
            $family = $option->family;
            // Compact the variables into an array
            $result = compact('name', 'family' );
            var_dump($result);
//            var_dump($option);
            $modeldropdownOptions = ArrayHelper::map($options,'id','family');
        }
        //dropdown option 2
        $carDetail = new Cardetail();
        $carOptions = Cardetail::find()->where(['>', 'inventory', 0])->all();
        $carDropDownOptions = [];


        foreach ($carOptions as $option) {
            // Find the CarModel related to the current Cardetail option
            $carModel = CarModel::find()->where(['id' => $option->id_car])->one();

            // Check if CarModel exists
            if ($carModel !== null) {
                // Concatenate the desired attributes from CarModel
                $carDropDownOptions= ArrayHelper::map($carOptions, 'id_car', 'id_car','inventory');
            } else {//                $count=$inventory->inventory;
//                $count=$count-1;
                // Handle case where CarModel is not found
                $carDropDownOptions[$option->id_car] = $option->id_car . " inventory: " . $option->inventory . " features : Not Found";
            }
        }
        if ($order->load(Yii::$app->request->post())) {
            // we have to get foreig keys first
            $order->car_id = Yii::$app->request->post('Cardetail')['id_car'];
            $order->customer_id = Yii::$app->request->post('Customer')['id'];
            $order->initial_price = Yii::$app->request->post('Cardetail')['initialPrice'];

            //$id=$order->customer_id;

            // Debugging: Check if data is loaded and validated correctly
                //now we have to save the data
            if ($order->save()) {
                //message
                Yii::$app->session->setFlash('success', 'Order placed successfully.');
                //decreading the invetory of selected car
                $parchased_car=Yii::$app->request->post('Cardetail')['id_car'];
                $inventory=$carDetail::find()->where(['id_car'=>$parchased_car])->one();
                $inventory->updateCounters(['inventory' => -1]);

                 $this->redirect(['success']);



            } else {
                // Debugging: Output validation errors if save fails
                var_dump($order->errors);
                Yii::$app->session->setFlash('error', 'Failed to place the order.');
            }
        }


        return $this->render('create',[
            'modeldropdownOptions' => $modeldropdownOptions,
            'customer' => $customer,
            'carDetail' => $carDetail,
            'carDropDownOptions' => $carDropDownOptions,
            'order'=>$order
        ]);
    }
    public function actionGetCarOptions(): array//ajax
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $customerId = Yii::$app->request->post('id');

        // Find all cars that the selected customer hasn't ordered yet
        $unorderedCars = Cardetail::find()
            ->where(['not in', 'id_car', Orders::find()->select('car_id')->where(['customer_id' => $customerId])])
            ->andWhere(['>', 'inventory', 0])
            ->all();

        return $unorderedCars;

    }
    public function actionGetInitPrice(): array //ajax
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $carid=yii::$app->request->post('id');
        // Fetch the initial price you want to set to the text field
        $initialPrice = Cardetail::find()
        ->select('initialPrice')->where(['id_car' => $carid])->scalar();


        // Replace this with your logic

        return ['initialPrice' => $initialPrice];

    }
    public function actionGetTotalPrice(): array //ajax
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $carid=yii::$app->request->post('id');

        $initialPrice = Cardetail::find()
            ->select('initialPrice')->where(['id_car' => $carid])->scalar();

        $NewPrice = $initialPrice + ( $initialPrice * 0.09);

        return ['NewPrice' => $NewPrice];

    }
    public function actionSuccess(): string{
        return $this->render('success');
    }

}

?>