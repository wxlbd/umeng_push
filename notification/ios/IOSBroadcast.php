<?php

namespace umeng_push\notification\ios;

use umeng_push\notification\IOSNotification;

require_once __DIR__ . '/../IOSNotification.php';

class IOSBroadcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "broadcast";
    }
}