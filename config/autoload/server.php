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
use App\Server\TcpServer;
use Hyperf\Framework\Bootstrap\PipeMessageCallback;
use Hyperf\Framework\Bootstrap\WorkerExitCallback;
use Hyperf\Framework\Bootstrap\WorkerStartCallback;
use Hyperf\Server\Event;
use Hyperf\Server\Server;
use Swoole\Constant;

use function Hyperf\Support\env;

return [
    'mode' => SWOOLE_PROCESS,
    'servers' => [
        //        [
        //            'name' => 'http',
        //            'type' => Server::SERVER_HTTP,
        //            'host' => '0.0.0.0',
        //            'port' => 9501,
        //            'sock_type' => SWOOLE_SOCK_TCP,
        //            'callbacks' => [
        //                Event::ON_REQUEST => [Hyperf\HttpServer\Server::class, 'onRequest'],
        //            ],
        //            'options' => [
        //                // Whether to enable request lifecycle event
        //                'enable_request_lifecycle' => false,
        //            ],
        //        ],
        [
            'name' => 'tcp',
            'type' => Server::SERVER_BASE,
            'host' => '0.0.0.0',
            'port' => (int) env('TCP_PORT', 9500),
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_RECEIVE => [TcpServer::class, 'onReceive'],
                Event::ON_CONNECT => [TcpServer::class, 'onConnect'],
                Event::ON_CLOSE => [TcpServer::class, 'onClose'],
            ],
            'settings' => [
                // 按需配置
            ],
        ],
    ],
    'settings' => [
        Constant::OPTION_ENABLE_COROUTINE => true,
        Constant::OPTION_WORKER_NUM => 1, // swoole_cpu_num(),
        Constant::OPTION_PID_FILE => BASE_PATH . '/runtime/hyperf.pid',
        Constant::OPTION_OPEN_TCP_NODELAY => true,
        Constant::OPTION_MAX_COROUTINE => 100000,
        Constant::OPTION_OPEN_HTTP2_PROTOCOL => true,
        Constant::OPTION_MAX_REQUEST => 100000,
        Constant::OPTION_SOCKET_BUFFER_SIZE => 2 * 1024 * 1024,
        Constant::OPTION_BUFFER_OUTPUT_SIZE => 2 * 1024 * 1024,
    ],
    'callbacks' => [
        Event::ON_WORKER_START => [WorkerStartCallback::class, 'onWorkerStart'],
        Event::ON_PIPE_MESSAGE => [PipeMessageCallback::class, 'onPipeMessage'],
        Event::ON_WORKER_EXIT => [WorkerExitCallback::class, 'onWorkerExit'],
    ],
];
