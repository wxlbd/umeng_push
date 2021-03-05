<?php

namespace umeng_push\notification\android;

use umeng_push\notification\AndroidNotification;
use umeng_push\PushException;

class AndroidCustomizedcast extends AndroidNotification
{

    protected $data;

    public function __construct()
    {
        parent::__construct();
        $this->data["type"] = "customizedcast";
        $this->data["alias_type"] = 'ALIAS_TYPE_USERID';
    }

    public function isComplete(): bool
    {
        parent::isComplete();
        if (!array_key_exists("alias", $this->data) && !array_key_exists("file_id", $this->data)) {
            throw new PushException("You need to set alias or upload file for customizedcast!");
        }
        return true;
    }

    public function getFileId()
    {
        return $this->data["file_id"] ?? NULL;
    }

    /**
     * @param $ticker
     * @throws PushException
     */
    public function setTicker($ticker): void
    {
        $this->setPredefinedKeyValue('ticker', $ticker);
    }


    /**
     * @param $title
     * @throws PushException
     */
    public function setTitle($title): void
    {
        $this->setPredefinedKeyValue('title', $title);
    }

    /**
     * @param $body
     * @throws PushException
     */
    public function setBody($body): void
    {
        $this->setPredefinedKeyValue('body', $body);
    }

    /**
     * @param $after_open
     * @throws PushException
     */
    public function setAfterOpen($after_open): void
    {
        $this->setPredefinedKeyValue('after_open', $after_open);
    }

    /**
     * @param $production_mode
     * @throws PushException
     */
    public function setProductionMode($production_mode): void
    {
        $this->setPredefinedKeyValue('production_mode', $production_mode);
    }
}