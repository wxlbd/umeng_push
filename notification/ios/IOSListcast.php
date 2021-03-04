<?php

namespace umeng\notification\ios;

use umeng\notification\IOSNotification;

class IOSListcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = NULL;
    }

}