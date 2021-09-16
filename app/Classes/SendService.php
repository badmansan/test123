<?php declare(strict_types=1);
namespace App\Classes;

use App\Contracts\SendServiceInterface;
use App\Classes\Services\AmericanSendServic;
use App\Classes\Services\AsianSendService;
use App\Classes\Services\EuropeanSendService;

class SendService implements SendServiceInterface
{
    protected $sendService;

    public function sendWithAmericanService()
    {
        $this->sendService = new AmericanSendServic();
        return $this;
    }

    public function sendWithAsianService()
    {
        $this->sendService = new AsianSendService();
        return $this;
    }

    public function sendWithEuropeanService()
    {
        $this->sendService = new EuropeanSendService();
        return $this;
    }

    public function setMessage($message): SendServiceInterface
    {
        $this->sendService->setMessage($message);
        return  $this->sendService;
    }

    public function setPhoneNumber($phoneNumber): SendServiceInterface
    {
        $this->sendService->setPhoneNumber($phoneNumber);
        return  $this->sendService;
    }

    public function send(): string
    {
        return $this->sendService->send();
    }
}