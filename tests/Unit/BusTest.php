<?php

namespace Tests\Unit;

use Exception;
use Hera\Bus\Bus;
use PHPUnit\Framework\TestCase;

class BusTest extends TestCase
{

    public function testBusInstance(): Bus {
        $bus = new Bus();

        $this->assertInstanceOf(Bus::class, $bus);

        return $bus;
    }

    /**
     * @cover \Hera\Bus\Bus::register
     * @depends testBusInstance
     */
    public function testRegisterException(Bus $bus): void {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("DummyQuery or DummyHandler is not valid class name.");

        $bus->register("DummyQuery", "DummyHandler");
    }

    /**
     * @cover \Hera\Bus\Bus::resolverHandler
     * @depends testBusInstance
     */
    public function testResolveHandlerException(Bus $bus): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Handler for query DummyQuery not found");

        $bus->resolveHandler("DummyQuery");
    }
}
