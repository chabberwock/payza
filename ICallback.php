<?php
/**
* @author Alexandr Makarov
* Email: notengine@gmail.com
*/
namespace chabberwock\payza;

interface ICallback
{
    public function run(array $data);
}
  
?>
