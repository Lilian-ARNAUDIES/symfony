<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    public function testOrderSettersAndGetters()
    {
        $order = new Order();
        
        $order->setNumber('1');
        $this->assertEquals('1', $order->getNumber());

        $order->setTotalPrice(5);
        $this->assertEquals(5, $order->getTotalPrice());

        $order->setUserId(1);
        $this->assertEquals(1, $order->getUserId());
    }
}