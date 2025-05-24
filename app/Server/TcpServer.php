<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Server;

use App\Tool\BIN;
use Hyperf\Contract\OnReceiveInterface;

class TcpServer implements OnReceiveInterface
{
    /**
     * @function: onReceive
     * @Desc: 接收到数据时调用
     */
    public function onReceive($server, int $fd, int $reactorId, string $data): void
    {
        BIN::dump($data);
        echo "recv: {$data}\n";
        $server->send($fd, 'recv:' . $data);
    }

    public function onConnect($server, int $fd): void
    {
        echo "connect: {$fd}\n";
    }

    public function onClose($server, int $fd): void
    {
        echo "close: {$fd}\n";
    }
}
