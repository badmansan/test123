<?php declare(strict_types=1);
namespace App\Classes\Services;

class AsianSendService extends AbstractSendService
{
    public function send(): string
    {
        return \App\Classes\MockResponseService::resiveNessage( __METHOD__, $this->phoneNumber, $this->message);
    }
}