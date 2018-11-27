<?php

use Phalcon\Cli\Task;

class MainTask extends BaseTask
{
    public function MainAction()
    {
        $this->print("123");
    }
}