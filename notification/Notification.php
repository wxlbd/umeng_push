<?php

namespace umeng_push\notification;

use JsonException;
use umeng_push\PushException;

abstract class Notification
{
    // The host
    protected $host = "http://msg.umeng.com";

    // The upload path
    protected $uploadPath = "/upload";

    // The post path
    protected $postPath = "/api/send";

    // The app master secret
    protected $appMasterSecret = NULL;

    /*
     * $data用于构造POST请求的json字符串。注：
     * 1)注释中的键/值对是可选的。
     * 2)键“payload”的值在子类（AndroidNotification或IOSNotification）中设置，因为它们的有效负载结构不同
    */
    protected $data = array(
        "appkey" => NULL,
        "timestamp" => NULL,
        "type" => NULL,
        //"device_tokens"  => "xx",
        //"alias"          => "xx",
        //"file_id"        => "xx",
        //"filter"         => "xx",
        //"policy"         => array("start_time" => "xx", "expire_time" => "xx", "max_send_num" => "xx"),
        "production_mode" => "true",
        //"feedback"       => "xx",
        //"description"    => "xx",
        //"thirdparty_id"  => "xx"
    );

    protected $DATA_KEYS = array("appkey", "timestamp", "type", "device_tokens", "alias", "alias_type", "file_id", "filter", "production_mode",
        "feedback", "description", "thirdparty_id");
    protected $POLICY_KEYS = array("start_time", "expire_time", "max_send_num");

    protected $result;
    /**
     * @var mixed
     */
    protected $httpCode;
    /**
     * @var int
     */
    protected $curlErrNo;
    /**
     * @var string
     */
    protected $curlErr;
    /**
     * @var string
     */
    protected $type;


    public function __construct()
    {

    }

    public function setAppMasterSecret($secret): void
    {
        $this->appMasterSecret = $secret;
    }

    //return TRUE if it's complete, otherwise throw exception with details

    /**
     * @return bool
     * @throws PushException
     */
    public function isComplete(): bool
    {
        if (is_null($this->appMasterSecret)) {
            throw new PushException("Please set your app master secret for generating the signature!");
        }
        $this->checkArrayValues($this->data);
        return true;
    }

    /**
     * @param $arr
     * @throws PushException
     */
    protected function checkArrayValues($arr): void
    {
        foreach ($arr as $key => $value) {
            if (is_null($value)) {
                throw new PushException($key . " is NULL!");
            }
            if (is_array($value)) {
                $this->checkArrayValues($value);
            }
        }
    }

    // Set key/value for $data array, for the keys which can be set please see $DATA_KEYS, $PAYLOAD_KEYS, $BODY_KEYS, $POLICY_KEYS
    abstract public function setPredefinedKeyValue($key, $value);

    /**
     * 将通知发送到umeng，如果成功则返回响应数据，否则将抛出包含详细信息的异常。
     * @return mixed
     * @throws PushException
     * @throws JsonException
     */
    public function send()
    {
        //check the fields to make sure that they are not NULL
        $this->isComplete();
        $postBody = json_encode($this->data, JSON_THROW_ON_ERROR);
        $url = $this->buildUrl($this->postPath, $postBody);
        $this->httpRequest($url, $postBody);
        $this->checkResult();
        return $this->result;
    }


    /**
     * 检查发送请求后响应的状态码
     * @throws PushException
     */
    protected function checkResult(): void
    {
        if ((string)$this->httpCode === "0") {
            // Time out
            throw new PushException("Curl error number:" . $this->curlErrNo . " , Curl error details:" . $this->curlErr . "\r\n");
        }
        if ((string)$this->httpCode !== "200") {
            // We did send the notification out and got a non-200 response
            throw new PushException("Http code:" . $this->httpCode . " details:" . $this->result . "\r\n");
        }
    }

    /**
     * @param $url
     * @param $data
     */
    protected function httpRequest($url, $data): void
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $this->result = json_decode(curl_exec($ch), true);
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->curlErrNo = curl_errno($ch);
        $this->curlErr = curl_error($ch);
        curl_close($ch);
    }

    /**
     * @param $content
     * @throws PushException
     */
    public function uploadContents($content): void
    {
        $this->checkData();
        $this->checkContent($content);
        $postBody = $this->buildPostData($content);
        $url = $this->buildUrl($this->uploadPath, $postBody);
        $this->httpRequest($url, $postBody);
    }

    /**
     * @throws PushException
     */
    public function checkData(): void
    {
        if ($this->data["appkey"] === NULL) {
            throw new PushException("appkey should not be NULL!");
        }
        if ($this->data["timestamp"] === NULL) {
            throw new PushException("timestamp should not be NULL!");
        }
    }

    /**
     * @param $content
     * @throws PushException
     */
    public function checkContent($content): void
    {
        if (!is_string($content)) {
            throw new PushException("内容应该是字符串！");
        }
    }


    /**
     * 生成要发送的数据
     * @param $content
     * @return false|string
     */
    public function buildPostData($content)
    {
        return json_encode([
            "appkey" => $this->data["appkey"],
            "timestamp" => $this->data["timestamp"],
            "content" => $content
        ]);
    }

    /**
     * 生成要发送的url地址
     * @param $path
     * @param $postBody
     * @return string
     */
    public function buildUrl($path, $postBody): string
    {
        return $this->host . $path . "?sign=" . md5("POST" . $this->host . $path . $postBody . $this->appMasterSecret);
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function success(): bool
    {
        return (string)$this->httpCode === '200';
    }

    /**
     * @param $app_key
     */
    public function setAppKey(string $app_key): void
    {
        $this->data['appkey'] = $app_key;
    }

    /**
     * @param $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->data['timestamp'] = (string)$timestamp;
    }

    public function setAlias($alias): void
    {
        $this->data['alias'] = $alias;
    }

    /**
     * @param $production_mode
     */
    public function setProductionMode(bool $production_mode = true): void
    {
        $this->data['production_mode'] = $production_mode;
    }

    public function setAfterOpen(string $after_open = 'go_custom'): void
    {

    }

    public function setCustom(array $custom): void
    {

    }

    public function setDescription(string $description): void
    {
        $this->data['description'] = $description;
    }
}