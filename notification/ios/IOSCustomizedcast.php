<?php

namespace umeng\notification\ios;

use umeng\notification\IOSNotification;
use umeng\PushException;

class IOSCustomizedcast extends IOSNotification
{

    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "customizedcast";
        $this->data["alias_type"] = NULL;
    }

    public function isComplete():bool
    {
        parent::isComplete();
        if (!array_key_exists("alias", $this->data) && !array_key_exists("file_id", $this->data)){
            throw new PushException("You need to set alias or upload file for customizedcast!");
        }
    }


    public function getFileId()
    {
        return $this->data["file_id"] ?? NULL;
    }
}