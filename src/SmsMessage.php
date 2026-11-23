<?php

namespace JawadAhmed\SmsChannel;

final readonly class SmsMessage
{
    public function __construct(public string $content, public ?string $from = null)
    {
        if (trim($content) === '') throw new \InvalidArgumentException('SMS content cannot be empty.');
    }
}
