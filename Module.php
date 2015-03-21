<?php

namespace chabberwock\payza;

class Module extends \yii\base\Module
{

    public $defaultButtonConfig = [
        'ap_merchant' => 'payza_merchant@test.com',
        'ap_currency' => 'USD',
        'ap_purchasetype' => 'item'
    ];
    
    public $security_code;

    public $checkoutUrl = 'https://secure.payza.com/checkout';
    public $buttonImageUrl = 'https://www.payza.com/images/payza-buy-now.png';
    
    public $controllerNamespace = 'chabberwock\payza\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
