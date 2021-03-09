<?php

namespace umeng_push\notification;


use umeng_push\PushException;

class AndroidNotification extends Notification
{
    // The array for payload, please see API doc for more information
    protected $androidPayload = [
        "display_type" => "notification",
        "body" => [
            "ticker" => NULL,
            "title" => NULL,
            "text" => NULL,
            //"icon"       => "xx",
            //largeIcon    => "xx",
            "play_vibrate" => "true",
            "play_lights" => "true",
            "play_sound" => "true",
            "after_open" => NULL,
            //"url"        => "xx",
            //"activity"   => "xx",
            //custom       => "xx"
        ],
        //"extra"       => array("key1" => "value1", "key2" => "value2")
    ];
    // Keys can be set in the payload level
    protected $PAYLOAD_KEYS = ["display_type"];

    // 可以在body层设置的key
    protected $BODY_KEYS = [
        "ticker",
        "title",
        "text",
        "builder_id",
        "icon",
        "largeIcon",
        "img",
        "play_vibrate",
        "play_lights",
        "play_sound",
        "after_open",
        "url",
        "activity",
        "custom"
    ];

    public function __construct()
    {
        parent::__construct();
        $this->data["payload"] = $this->androidPayload;
    }

    // Set key/value for $data array, for the keys which can be set please see $DATA_KEYS, $PAYLOAD_KEYS, $BODY_KEYS, $POLICY_KEYS

    /**
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
        } elseif (in_array($key, $this->PAYLOAD_KEYS)) {
            $this->buildPayload($key, $value);
        } elseif (in_array($key, $this->BODY_KEYS)) {
            $this->data["payload"]["body"][$key] = $value;
            if ($key === "after_open" && $value === "go_custom" && !array_key_exists("custom", $this->data["payload"]["body"])) {
                $this->data["payload"]["body"]["custom"] = NULL;
            }
        } elseif (in_array($key, $this->POLICY_KEYS)) {
            $this->data["policy"][$key] = $value;
        } else {
            if ($key === "payload" || $key === "body" || $key === "policy" || $key === "extra") {
                throw new PushException("You don't need to set value for ${key} , just set values for the sub keys in it.");
            }

            throw new PushException("Unknown key: ${key}");
        }

    }

    /**
     * @param $key
     * @param $value
     */
    public function buildPayload($key, $value): void
    {
        $this->data["payload"][$key] = $value;
        if ($key === "display_type" && $value === "message") {
            $this->data["payload"]["body"]["ticker"] = "";
            $this->data["payload"]["body"]["title"] = "";
            $this->data["payload"]["body"]["text"] = "";
            $this->data["payload"]["body"]["after_open"] = "";
            if (!array_key_exists("custom", $this->data["payload"]["body"])) {
                $this->data["payload"]["body"]["custom"] = NULL;
            }
        }
    }
    // Set extra key/value for Android notification

    /**
     * @param string $key
     * @param $value
     */
    public function setExtraField(string $key, $value): void
    {
        $this->data["payload"]["extra"][$key] = $value;
    }


    /**
     * 通知栏提示文字
     * @param $ticker
     */
    public function setTicker($ticker): void
    {
        $this->data["payload"]["body"]["ticker"] = $ticker;
    }


    /**
     * 通知标题
     * @param $title
     */
    public function setTitle($title): void
    {
        $this->data["payload"]["body"]["title"] = $title;
    }

    /**
     * 通知文字描述
     * @param $body
     */
    public function setBody($body): void
    {
        $this->data["payload"]["body"]["text"] = $body;
    }

    /**
     * 点击"通知"的后续行为，默认为打开app
     * "go_app": 打开应用
     * "go_url": 跳转到URL
     * "go_activity": 打开特定的activity
     * "go_custom": 用户自定义内容。
     * @param $after_open
     */
    public function setAfterOpen($after_open = 'go_custom'): void
    {
        $this->data["payload"]["body"]["after_open"] = $after_open;
        if ($after_open === 'go_custom') {
            $this->data["payload"]["body"]["custom"] = null;
        }
        if ($after_open === 'go_url') {
            $this->data["payload"]["body"]["url"] = null;
        }
        if ($after_open === 'go_activity') {
            $this->data["payload"]["body"]["activity"] = null;
        }
    }

    /**
     * 设置自定义的跳转类型
     * @param $custom
     */
    public function setCustom(array $custom): void
    {
        $this->data["payload"]["body"]["custom"] = $custom;
    }
}