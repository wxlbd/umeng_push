<?php

namespace umeng\notification\android;

use umeng\notification\AndroidNotification;

class AndroidGroupcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "groupcast";
        $this->data["filter"] = NULL;
    }
}