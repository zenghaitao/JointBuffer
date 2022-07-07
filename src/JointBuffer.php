<?php
declare(strict_types=1);

namespace ZenStudio\JointBuffer;

use Google\Protobuf\Internal\Message;

class JointBuffer
{
    /**
     * 数据解包
     * @param string $data
     * @return array
     */
    public function unPack(string $data): array
    {
        //从二进制流中分离出len和buf
        $data = @unpack('Clen/a*buf', $data);
        if ($data['len'] && $data['buf']) {
            //根据len分离出cmd和data
            $format = "a{$data['len']}cmd/a*data";
            $package = @unpack($format, $data['buf']);
            return [$package['cmd'], $package['data']];
        }
        return [];
    }

    /**
     * 数据打包
     * @param Message $CmdMessage
     * @param Message|null $DataMessage
     * @return string
     */
    public function Pack(Message $CmdMessage, Message $DataMessage = null): string
    {
        $cmd_buffer = $CmdMessage->serializeToString();
        //cmd数据包长度
        $cmd_len = strlen($cmd_buffer);
        //构造完整二进制数据流
        $buffer = pack('C', $cmd_len) . $cmd_buffer;
        //拼接第二段数据包
        if($DataMessage){
            $buffer .= $DataMessage->serializeToString();
        }
        return $buffer;
    }

}