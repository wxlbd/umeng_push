# 友盟推送


## 安装
```
composer require wxl/umeng_push dev-main
```

## 使用

```php
        $unicast = new AndroidUnicast();
        $unicast->setAppMasterSecret('qtj0zlwdpck94i9ojk9wprd2zetdggf0');
        $unicast->setPredefinedKeyValue("appkey", '5fd3212cdd289153391a473d');
        $unicast->setPredefinedKeyValue("timestamp", (string)time());
        // Set your device tokens here
        $unicast->setPredefinedKeyValue("device_tokens", "AskQeB7To7qGvM712DiXR3CZjPpaR5Q_sCBthUBtWt8s");
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
        $unicast->setAppMasterSecret('cpt0wrbyqlsfvfaooeus9cmomvqjjebf');
        $unicast->setPredefinedKeyValue("appkey", '5fd323a2dd289153391a5381');
        $unicast->setPredefinedKeyValue("timestamp", (string)time());
        // Set your device tokens here
        $unicast->setPredefinedKeyValue("device_tokens", "d97e5d62a2a4b115fc6b3d11329da68da6abc022b87a2ee99145c285375f634e");
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