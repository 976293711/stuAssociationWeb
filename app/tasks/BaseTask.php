<?php

use Phalcon\Cli\Task;

class BaseTask extends Task
{

    /**
     * @var Redis
     */
    protected $redis;

    protected function init(){

        $this->redis = \Phalcon\Di::getDefault()->getShared('redis');
    }

    /**
     * 打印信息
     * @param $msg
     */
    protected function print($msg){
        echo date('Y-m-d H:i:s').":";
        echo get_class($this).":".$msg."\r\n";
    }
}