<?php

namespace umeng\notification\ios;

use umeng\notification\IOSNotification;

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