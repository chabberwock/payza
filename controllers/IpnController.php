<?php

namespace chabberwock\payza\controllers;

use yii\web\Controller;
use chabberwock\payza\Notification;
use yii\web\BadRequestHttpException;

class IpnController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        if (\Yii::$app->request->post('token') === null)
        {
            \Yii::error('Token was not specified in notification', 'payza');
            throw new BadRequestHttpException();
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->module->ipnHandler);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'token=' . urlencode(\Yii::$app->request->post('token')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        
        if(strlen($response) > 0)
        {
            if(urldecode($response) == "INVALID TOKEN")
            {
                \Yii::error('Invalid token', 'payza');
            }
            else
            {
                //urldecode the received response from Payza's IPN V2
                $response = urldecode($response);
                \Yii::info($response, 'payza');
                //split the response string by the delimeter "&"
                $aps = explode("&", $response);
                foreach ($aps as $ap)
                {
                    //put the IPN information into an associative array $info
                    $ele = explode("=", $ap);
                    $info[$ele[0]] = $ele[1];
                }
                
                if (!$this->module->get('callback')->run($info))
                {
                    throw new BadRequestHttpException();
                }
            }
        }
        else
        {
            \Yii::error('no response received from Payza');
            //something is wrong, no response is received from Payza
        }        
        
    }
}
