<?php
namespace umeng_push\notification\android;

use umeng_push\notification\AndroidNotification;

class AndroidListcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = NULL;
    }

}