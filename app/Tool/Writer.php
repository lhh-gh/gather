<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: SillyCat
 * Date: 2025-05-25
 * Time: 11:51
 */

namespace App\Tool;

class Writer
{
    //二进制字符串
    private string $bin = '';
    //二进制字符串索引
    private int $index = 0;

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function writerShort(int $num): void
    {
        $this->bin .= BIN::short2Bin($num);
        $this->index += 2;
    }

    public function writerInt(int $num): void
    {
        $this->bin .= BIN::int2Bin($num);
        $this->index += 4;
    }

    public function writerLong(int $num): void
    {
        $this->bin .= BIN::long2Bin($num);
        $this->index += 8;
    }

    public function writerFloat(float $num): void
    {
        $this->bin .= BIN::float2Bin($num);
        $this->index += 4;
    }

    public function writerDouble(float $num): void
    {
        $this->bin .= BIN::double2Bin($num);
        $this->index += 8;
    }

}