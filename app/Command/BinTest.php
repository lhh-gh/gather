<?php

declare(strict_types=1);

namespace App\Command;

use App\Tool\BIN;
use App\Tool\Writer;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;

#[Command]
class BinTest extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('bin:test');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Bin Test');
    }

    public function handle()
    {
//        $bin = BIN::int2BinLE(1);
//        $result = BIN::bin2IntLE($bin);
//        echo $result;
        $writer = new Writer();
        $writer->writerInt(10);
        $writer->writerShort(1);
        $writer->writerLong(20);
        $writer->writerFloat(1.1);
        $writer->writerDouble(1.34);
        BIN::dump($writer->getBin());
        echo $writer->getIndex() . PHP_EOL;

//     BIN::dump(BIN::int2Bin(1));
//     BIN::dump(BIN::int2BinLE(1));
//     BIN::dump(BIN::short2Bin(1));
//     BIN::dump(BIN::short2BinLE(1));
//     BIN::dump(BIN::long2Bin(1));
//     BIN::dump(BIN::long2BinLE(1));
//     BIN::dump(BIN::float2Bin(1.34));
//     BIN::dump(BIN::float2BinLE(1.34));
    }
}
