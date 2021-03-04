<?php

namespace umeng\notification\android;

use umeng\notification\AndroidNotification;

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