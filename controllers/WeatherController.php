<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use GuzzleHttp\Client;

class WeatherController extends Controller
{

    public function actionIndex(): string
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.openweathermap.org/data/2.5/weather?id=2172797&appid=41f624af947cd061926218ccffbc755a',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $response = $client->request('GET', 'weather', [
            'query' => [
                'id' => 2172797,
                'appid' => '41f624af947cd061926218ccffbc755a',
            ],
        ]);

        // Check the response status code and get the response content
        if ($response->getStatusCode() == 200) {
            $data = $response->getBody()->getContents();
            $finaldata = json_decode($data, true);
//            print_r($finaldata);

            // Process the data as needed
        }

        return $this->render('index',[
            'finaldata' => $finaldata,
        ]);
    }


}


?>