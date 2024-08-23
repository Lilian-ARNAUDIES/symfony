<?php

namespace App\Service;

class Invoice
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function process(string $email, float $amount): bool
    {
        $message = "Votre commande d’un montant de " . number_format($amount, 2) . " euros est confirmée";
        return $this->emailService->send($email, $message);
    }
}