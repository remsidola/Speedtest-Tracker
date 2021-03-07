<?php

namespace Tests\Unit\Helpers\SpeedtestHelper;

use App\Utils\OoklaTester;
use PHPUnit\Framework\TestCase;

class CheckOutputTest extends TestCase
{
    private OoklaTester $speedtestProvider;

    public function __construct()
    {
        $this->speedtestProvider = new OoklaTester();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGoodOutput()
    {
        $expected = [
            'type' => 'result',
            'download' => ['bandwidth' => '*'],
            'upload' => ['bandwidth' => '*'],
            'ping' => ['latency' => '*'],
            'server' => [
                'id' => '*',
                'name' => '*',
                'host' => '*',
                'port' => '*',
            ],
            'result' => [
                'url' => '*',
            ]
        ];

        $this->assertTrue($this->speedtestProvider->isOutputComplete($expected));
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBadOutput()
    {
        $expected = [
            'type' => 'result',
            'download' => ['bandwidth' => '*'],
            'server' => [
                'id' => '*',
                'name' => '*',
                'host' => '*',
                'port' => '*',
            ],
            'result' => [
                'url' => '*',
            ]
        ];

        $this->assertFalse($this->speedtestProvider->isOutputComplete($expected));
    }
}
