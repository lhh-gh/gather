<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
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
//    //整型转二进制
//    public static function int2Bin(int $num){
//        return pack('i',$num);
//    }

    /**
     * @function: isLE
     * @Desc: 判断当前系统是否是小端序
     * @return bool
     */
    public static function isLE(): bool
    {
        $ret = pack('s', 1);

        if (bin2hex($ret[0]) === '01') {
            return true;//大端序
        }
        return false;//小端序
//        return "\x01" === pack('s', 1)[0];

    }

    /**
     * @function: int2BinB
     * @Desc: 整型转二进制 大端  01 00 00 00
     * @param  int  $num
     * @return string
     */
    public static function int2Bin(int $num): string
    {
        $ret = pack('i', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }

    /**
     * @function: int2BinLE
     * @Desc: 整型转二进制 小端  00 00 00 01
     * @param  int  $num
     * @return string
     */
    public static function int2BinLE(int $num): string
    {
//        if (static::isLE()) {
//            // 小端序
//            return pack('V', $num);
//        } else {
//            // 大端序
//            return pack('N', $num);
//        }
        $ret = pack('i', $num);
        if (static::isLE()) {
            // 小端序
            return $ret;
        }
        //  大端序
        return strrev($ret);
    }

    /**
     * @function: short2Bin
     * @Desc: 短整型转二进制大端
     * @param  int  $num
     * @return string
     */
    public static function short2Bin(int $num): string
    {
        $ret = pack('n', $num);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);

    }
//小端序是“01 00”，大端序是“00 01”。
//网络协议（如 TCP/IP 协议通常使用大端模式
    /**
     * @function: short2BinLE
     * @Desc: 短整型转二进制小端
     * @param  int  $num
     * @return string
     */
    public static function short2BinLE(int $num): string
    {
        $ret = pack('n', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }


    public static function long2Bin(int $num)
    {
        $ret = pack('q', $num);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }

    public static function long2BinLE(int $num)
    {
        $ret = pack('q', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }
    public static function float2Bin(float $num)
    {
        $ret = pack('f', $num);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }
    public static function float2BinLE(float $num)
    {
        $ret = pack('f', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }
    public static function double2Bin(float $num)
    {
        $ret = pack('d', $num);
        if (static::isLE()) {
            return $ret;
        }
        return strrev($ret);
    }
    public static function double2BinLE(float $num)
    {
        $ret = pack('d', $num);
        if (static::isLE()) {
            return strrev($ret);
        }
        return $ret;
    }
    public static function string2Bin(string $str)
    {
        return pack('a*', $str);
    }
    public static function string2BinLE(string $str)
    {
        return strrev(pack('a*', $str));
    }
  public static function  bin2Int(string $bin):int
  {

      if(static::isLE())
      {
          return unpack('i',strrev($bin))[1];
      }
      return unpack('i',$bin)[1];

  }
  public static  function bin2IntLE(string $bin):int
  {
      if(static::isLE())
      {
          return unpack('i',$bin)[1];
      }
      return unpack('i',strrev($bin))[1];
  }
}
