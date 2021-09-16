<?php declare(strict_types=1);
namespace App\Contracts;

interface SendServiceInterface
{
    public function setMessage($message): SendServiceInterface;
    public function setPhoneNumber($phoneNumber): SendServiceInterface;
    public function send(): string;
}