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
        $ios->setAppMasterSecret('cpt0wrbyqlsfvfaooeus9cmomvqjjebf');
        $ios->setAppKey('5fd323a2dd289153391a5381');
        $ios->setPredefinedKeyValue("timestamp", (string)time());
        $ios->setPredefinedKeyValue("device_tokens", "d97e5d62a2a4b115fc6b3d11329da68da6abc022b87a2ee99145c285375f634e");
        $ios->setPredefinedKeyValue("alert", "IOS 单播测试");
        $ios->setPredefinedKeyValue("badge", 0);
        $ios->setPredefinedKeyValue("sound", "chime");
        $ios->setPredefinedKeyValue("production_mode", "false");
        $ios->setAfterOpen();
        $ios->setCustom(['type' => 1, 'goods_id' => 123]);
        $ios->send();
```