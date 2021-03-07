# 友盟推送


## 安装
```
composer require wxl/umeng_push dev-main
```

## 使用

```php
        $android = new AndroidCustomizedcast();
        $android->setAppMasterSecret('secret');
        $android->setAppKey('appkey');
        $android->setTimestamp(time());
        $android->setAlias($data['users']);
        $android->setTicker($data['ticker']);
        $android->setTitle($data['title']);
        $android->setBody($data['body']);
        $android->setAfterOpen();
        $android->setCustom($data['custom']);
        $android->send();

        $ios = new IOSUnicast();
        $ios->setAppMasterSecret('secret');
        $ios->setAppKey('appkey');
        $ios->setPredefinedKeyValue("timestamp", (string)time());
        $ios->setPredefinedKeyValue("device_tokens", "token");
        $ios->setPredefinedKeyValue("alert", "IOS 单播测试");
        $ios->setPredefinedKeyValue("badge", 0);
        $ios->setPredefinedKeyValue("sound", "chime");
        $ios->setPredefinedKeyValue("production_mode", "false");
        $ios->setAfterOpen();
        $ios->setCustom(['type' => 1, 'goods_id' => 123]);
        $ios->send();
```