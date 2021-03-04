<?php

namespace umeng_push\notification\android;

use umeng_push\notification\AndroidNotification;


class AndroidUnicast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "unicast";
        $this->data["device_tokens"] = NULL;
    }
}