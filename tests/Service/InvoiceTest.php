<?php

namespace App\Tests\Service;

use App\Service\EmailService;
use App\Service\Invoice;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceTest extends KernelTestCase
{
    public function testProcessSendsEmail()
    {
        $emailServiceMock = $this->createMock(EmailService::class);

        $emailServiceMock->expects($this->once())
                         ->method('send')
                         ->willReturn(true);

        $invoice = new Invoice($emailServiceMock);
        $result = $invoice->process('example@example.com', 100.00);

        $this->assertTrue($result);
    }
}
    