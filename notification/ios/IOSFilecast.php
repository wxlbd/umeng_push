<?php

namespace umeng_push\notification\ios;

use umeng_push\notification\IOSNotification;

class IOSFilecast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "filecast";
        $this->data["file_id"] = NULL;
    }

    //return file_id if SUCCESS, else throw Exception with details.

    public function getFileId()
    {
        return $this->data["file_id"] ?? NULL;
    }

}