<?php

namespace umeng\notification\ios;

use umeng\notification\IOSNotification;

class IOSUnicast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "unicast";
        $this->data["device_tokens"] = NULL;
    }

}