<?php

namespace chabberwock\payza;

class Module extends \yii\base\Module
{
    public $defaultButtonConfig = [
        'ap_merchant' => 'payza_merchant@test.com',
        'ap_currency' => 'USD',
        'ap_purchasetype' => 'item'
    ];
    
    public $checkoutUrl = 'https://secure.payza.com/checkout';
    public $buttonImageUrl = 'https://www.payza.com/images/payza-buy-now.png';
    public $ipnHandler = 'https://sandbox.Payza.com/sandbox/IPN2.ashx';
    
    public $controllerNamespace = 'chabberwock\payza\controllers';

    public function init()
    {
        parent::init();
        if (!($this->get('callback') instanceof ICallback))
        {
            throw new \yii\base\InvalidConfigException('[callback] component must be specified and implement ICallback interface');
        }
        // custom initialization code goes here
    }
}
