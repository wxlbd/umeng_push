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

        $ios = new IOSCustomizedcast();
        $ios->setAppMasterSecret('secret');
        $ios->setAppKey('appkey');
        $ios->setTimestamp(time());
        $ios->setAlias($data['users']);
        $ios->setTitle($data['ticker']);
        $ios->setSubtitle($data['title']);
        $ios->setBody($data['body']);
        $ios->setProductionMode(false);
        $ios->setAfterOpen();
        $ios->setCustom($data['custom']);
        $ios->send();
```