<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\TestModel;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SiteController extends Controller
{
    public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'nastaran was here !')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

        public function actionTest(){//test
        
        $test =new TestModel();

        //assiging attribute
        // $test -> name='jon';

        // $test['surename']='doe';
        // $test['email']='sasdasd@dhfisd.com';
        $post=[
            'name' => 'nastaran',
            'surename' => 'ebrahimi', 
            'email' => 'dklsdf@lsdhflsd.com',
            'Age'=>'23',
        ];
        $test->attributes =$post;


        echo $test['surename'];

        foreach ($test as $attr =>$value ){
            echo $test->getAttributeLabel($attr) . '=' . $value .'<br>'; 
        }

        echo var_dump($test->getAttributeLabel('name'));

        if($test->validate()){
            echo "successfully validated ";
        }else{
            echo "please enter your name ! the name value is null";
            echo var_dump($test->errors);
        }
    }
        public function actionRequest($id=0){

           echo isset($_GET['id']) ? $_GET['id'] : null;
           echo yii::$app->request->get('id',35);



        }
        public function actionResponse()
        {
            // // $response=yii::$app->response;
            // // $response->statusCode=500;
            // //  yii::$app->response->content= 'hello from nastaran';
            // yii::$app->response->format=Response::FORMAT_JSON;
            //     return[
            //         'name'=>'nastaran',
            //         'surename'=>'ansdlnd',
            //     ];

            //return Yii::$app->response->redirect('about' , 301);

            return yii::$app->response->sendFile('hello wold' , 'test.txt');
        }
    
}
