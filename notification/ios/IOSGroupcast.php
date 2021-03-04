<?php

namespace umeng\notification\ios;

use umeng\notification\IOSNotification;

class IOSGroupcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "groupcast";
        $this->data["filter"] = NULL;
    }
}