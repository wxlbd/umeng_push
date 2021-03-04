<?php
namespace umeng\notification\android;

use umeng\notification\AndroidNotification;

class AndroidListcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = NULL;
    }

}