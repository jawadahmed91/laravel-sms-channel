<?php

namespace JawadAhmed\SmsChannel;

interface SmsTransport
{
    public function send(string $to, SmsMessage $message): string;
}
