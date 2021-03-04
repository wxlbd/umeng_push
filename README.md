# 友盟推送


## 安装
```
composer require wxl/umeng_push dev-main
```

## 使用

```php
        $unicast = new AndroidUnicast();
        $unicast->setAppMasterSecret('xx');
        $unicast->setPredefinedKeyValue("appkey", 'xx');
        $unicast->setPredefinedKeyValue("timestamp", (string)time());
        // Set your device tokens here
        $unicast->setPredefinedKeyValue("device_tokens", "xx");
        $unicast->setPredefinedKeyValue("ticker", "Android unicast ticker");
        $unicast->setPredefinedKeyValue("title", "Android unicast title");
        $unicast->setPredefinedKeyValue("text", "Android unicast text");
        $unicast->setPredefinedKeyValue("after_open", "go_app");
        // Set 'production_mode' to 'false' if it's a test device.
        // For how to register a test device, please see the developer doc.
        $unicast->setPredefinedKeyValue("production_mode", "true");
        // Set extra field
        $unicast->setExtraField("test", "helloworld");
        print("Sending unicast notification, please wait...\r\n");
        $unicast->send();
        print("Sent SUCCESS\r\n");

        $unicast = new IOSUnicast();
        $unicast->setAppMasterSecret('xx');
        $unicast->setPredefinedKeyValue("appkey", 'xx');
        $unicast->setPredefinedKeyValue("timestamp", (string)time());
        // Set your device tokens here
        $unicast->setPredefinedKeyValue("device_tokens", "xx");
        $unicast->setPredefinedKeyValue("alert", "IOS 单播测试");
        $unicast->setPredefinedKeyValue("badge", 0);
        $unicast->setPredefinedKeyValue("sound", "chime");
        // Set 'production_mode' to 'true' if your app is under production mode
        $unicast->setPredefinedKeyValue("production_mode", "false");
        // Set customized fields
        $unicast->setCustomizedField("test", "helloworld");
//            print("Sending unicast notification, please wait...\r\n");
        $unicast->send();
```