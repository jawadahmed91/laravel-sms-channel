<?php

namespace Tests;

use JawadAhmed\SmsChannel\SmsChannel;
use JawadAhmed\SmsChannel\SmsMessage;
use JawadAhmed\SmsChannel\SmsTransport;
use PHPUnit\Framework\TestCase;

final class SmsChannelTest extends TestCase
{
    public function test_it_routes_and_sends_sms(): void
    {
        $transport = $this->createMock(SmsTransport::class);
        $transport->expects(self::once())->method('send')->with('+15551234567', self::isInstanceOf(SmsMessage::class))->willReturn('msg-1');
        $notifiable = new class { public function routeNotificationFor(): string { return '+15551234567'; } };
        $notification = new class { public function toSms(): SmsMessage { return new SmsMessage('Hello'); } };
        self::assertSame('msg-1', (new SmsChannel($transport))->send($notifiable, $notification));
    }
}
