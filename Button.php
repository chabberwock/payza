<?php
/**
* @author Alexandr Makarov
* Email: notengine@gmail.com
*/
namespace chabberwock\payza;
use \yii\helpers\Html;

class Button extends \yii\base\Widget
{
    public $ap_merchant;
    public $ap_purchasetype;
    public $ap_returnurl;
    public $ap_cancelurl;
    public $ap_currency;
    
    public $items = [];
    
    
    
    public function run()
    {
        $module = \Yii::$app->getModule('payza');
        \Yii::configure($this, $module->defaultButtonConfig);
        
        $html = '';
        $html .= Html::hiddenInput('ap_merchant', $this->ap_merchant);
        $html .= Html::hiddenInput('ap_purchasetype', $this->ap_purchasetype);
        $html .= Html::hiddenInput('ap_currency', $this->ap_currency);
        $html .= Html::hiddenInput('ap_returnurl', $this->ap_returnurl);
        $html .= Html::hiddenInput('ap_cancelurl', $this->ap_cancelurl);
        
        $i = 0;
        foreach ($this->items as $item)
        {   
            $idx = ($i==0) ? '' : '_' . $i;
            $html .= Html::hiddenInput('ap_itemname' . $idx, $item['name']);
            $html .= Html::hiddenInput('ap_description' . $idx, $item['description']);
            $html .= Html::hiddenInput('ap_itemcode' . $idx, $item['code']);
            $html .= Html::hiddenInput('ap_amount' . $idx, $item['amount']);
            $html .= Html::hiddenInput('ap_quantity' . $idx, $item['quantity']);
            $i++;
        }
        
        $html .= Html::input('image',null,null,['src'=>$module->buttonImageUrl]);
        
        
        return Html::tag('form',$html,['method'=>'post', 'action'=>$module->checkoutUrl]);
        
                
        
    }
}
 
?>
