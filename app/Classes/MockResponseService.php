<?php declare(strict_types=1);
namespace App\Classes;

final class MockResponseService
{
    public static function resiveNessage($method, $phoneNumber, $message): string
    {
        return 'Message Sended with: ' . $method . ' to phone number: ' . $phoneNumber . ' with message: ' . $message;
    }
}