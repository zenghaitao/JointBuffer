# component-joint-buffer
```
composer require zen-studio/joint-buffer
```

##使用方法
###对二进制流拆解
```php
list($cmd_buffer, $data_buffer) = make(IJointBuffer::class)->unPack($buffer);

//使用cmd的proto结构体进行解析
$CmdMessage = new CmdData();
$CmdMessage->mergeFromString($cmd_buffer);
if($CmdMessage->getCmdIndex() == '1100')
{
    $LoginMessage = new LoginData();
    $LoginMessage->mergeFromString($data_buffer);
}
```
###拼接Message结构体
```php
$buffer = make(IJointBuffer::class)->Pack($CmdMessage, $DataMessage);
```
