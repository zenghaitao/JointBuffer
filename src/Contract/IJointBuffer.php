<?php
declare(strict_types=1);

namespace ZenStudio\JointBuffer\Contract;

use Google\Protobuf\Internal\Message;

interface IJointBuffer
{
    /**
     * 数据流拆包
     * @param string $data
     * @return array
     */
    public function unPack(string $data): array;

    /**
     * Message拼装
     * @param Message $CmdMessage
     * @param Message|null $DataMessage
     * @return string
     */
    public function Pack(Message $CmdMessage, Message $DataMessage = null): string;
}