<?php declare(strict_types=1);
namespace App\Classes\Services;

use App\Contracts\SendServiceInterface;

abstract class AbstractSendService implements SendServiceInterface
{
    protected $message;
    protected $phoneNumber;

    public function setMessage($message): SendServiceInterface
    {
        $this->message = $message;
        return $this;
    }

    public function setPhoneNumber($phoneNumber): SendServiceInterface
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function send(): string
    {
        return 'Message Sended';
    }
}