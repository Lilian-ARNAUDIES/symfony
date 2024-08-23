<?php 

namespace App\Tests\Entity;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase {

    public function testSetGetName() {
        $product = new Product();
        $product->setName("produit");
        $this->assertEquals("produit", $product->getName());
    }


    public function testSetGetPrice() {
        $product = new Product();
        $product->setPrice("5");
        $this->assertEquals("5", $product->getPrice());
    }

}