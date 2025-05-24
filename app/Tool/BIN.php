<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: SillyCat
 * Date: 2025-05-24
 * Time: 20:55
 */

namespace App\Tool;

class BIN
{

//    // 二进制转十六进制
//    public static function dump(string $bin, bool $out = true)
//    {
//        $ret = [];
//        for ($i = 0; $i < strlen($bin); ++$i) {
//            //1字节
//            $ret[] = strtoupper(bin2hex(strval($bin[$i])));
//        }
//        if ($out) {
//            echo join(' ', $ret) . PHP_EOL;
//        } else {
//            return join(' ', $ret);
//        }
//    }
    public static function dump(string $bin, bool $out = true): ?string
    {
        // 一次性转换整个二进制字符串
        $hex = strtoupper(bin2hex($bin));

        // 用更高效的方式插入分隔符 (避免数组操作)
        $result = rtrim(chunk_split($hex, 2, ' '));  // 自动处理末尾空格

        if ($out) {
            echo $result . PHP_EOL;
            return null;
        }

        return $result;
    }
}