<?php

namespace umeng_push\notification\android;

use umeng_push\notification\AndroidNotification;

class AndroidFilecast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "filecast";
        $this->data["file_id"] = NULL;
    }

    public function getFileId()
    {
        return $this->data["file_id"] ?? NULL;
    }
}