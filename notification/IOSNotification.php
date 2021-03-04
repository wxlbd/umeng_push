<?php

namespace umeng_push\notification;


use umeng_push\PushException;

class IOSNotification extends Notification
{
    // The array for payload, please see API doc for more information
    protected $iosPayload = [
        "aps" => [
            "alert" => NULL
            //"badge"				=>  xx,
            //"sound"				=>	"xx",
            //"content-available"	=>	xx
        ]
        //"key1"	=>	"value1",
        //"key2"	=>	"value2"
    ];

    // 可以在aps级别设置的键
    protected $APS_KEYS = ["alert", "badge", "sound", "content-available"];

    public function __construct()
    {
        parent::__construct();
        $this->data["payload"] = $this->iosPayload;
    }

    /**
     * 设置$data数组的键/值
     * @param $key
     * @param $value
     * @throws PushException
     */
    public function setPredefinedKeyValue($key, $value): void
    {
        if (!is_string($key)) {
            throw new PushException("key should be a string!");
        }

        if (in_array($key, $this->DATA_KEYS)) {
            $this->data[$key] = $value;
        } else if (in_array($key, $this->APS_KEYS)) {
            $this->data["payload"]["aps"][$key] = $value;
        } else if (in_array($key, $this->POLICY_KEYS)) {
            $this->data["policy"][$key] = $value;
        } else if ($key === "payload" || $key === "policy" || $key === "aps") {
            throw new PushException("You don't need to set value for ${key} , just set values for the sub keys in it.");
        } else {
            throw new PushException("Unknown key: ${key}");
        }
    }

    /**
     * 为IOS通知设置额外的键/值
     * @param $key
     * @param $value
     * @throws PushException
     */
    public function setCustomizedField($key, $value): void
    {
        if (!is_string($key)) {
            throw new PushException("key should be a string!");
        }
        $this->data["payload"][$key] = $value;
    }
}