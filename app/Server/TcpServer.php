<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: SillyCat
 * Date: 2025-05-24
 * Time: 16:45
 */

namespace App\Server;

use Hyperf\Contract\OnReceiveInterface;

class TcpServer implements OnReceiveInterface
{
    /**
     * @function: onReceive
     * @Desc: 接收到数据时调用
     * @param $server
     * @param  int  $fd
     * @param  int  $reactorId
     * @param  string  $data
     */
    public function onReceive($server, int $fd, int $reactorId, string $data): void
    {
        echo $data.PHP_EOL;
        $server->send($fd, 'recv:' . $data);
    }
    public function onConnect($server, int $fd): void
    {
        echo "connect: $fd\n";
    }
    public function onClose($server, int $fd): void
    {
        echo "close: $fd\n";
    }
}