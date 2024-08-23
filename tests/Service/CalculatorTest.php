<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorTest extends KernelTestCase
{
    private $calculator;
    private $products;
    
    protected function setUp(): void
    {
        $this->calculator = new Calculator();
        $this->products = $this->getProducts();
    }

    protected function tearDown(): void
    {
        $this->calculator = null;
        $this->products = null;
    }

    public function getProducts()
    {
        return [
            [
                'product' => $this->createProduct("Ballon rouge", 10),
                'quantity' => 4
            ],
            [
                'product' => $this->createProduct("Ballon bleu", 5),
                'quantity' => 2
            ]
        ];
    }

    public function createProduct($name, $price)
    {
        return (new Product())
            ->setName($name)
            ->setPrice($price);
    }

    public function testGetTotalHT()
    {
        $totalHT = $this->calculator->getTotalHT($this->products);
        
        $this->assertEquals(50, $totalHT);
    }

    public function testGetTotalTTC()
    {
        $tva = 20;  
        $totalTTC = $this->calculator->getTotalTTC($this->products, $tva);
        
        $this->assertEquals(60, $totalTTC);
    }
}
