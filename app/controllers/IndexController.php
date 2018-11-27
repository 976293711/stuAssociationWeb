<?php

namespace Controllers;

class IndexController extends ControllerBase
{
    public function onConstruct()
    {
        parent::onConstruct();
    }

    public function test()
    {
        $a = 1;
        $a = 454;
        $array = [123,5454];
        de($array);
        //var_dump($array);

    }

}

