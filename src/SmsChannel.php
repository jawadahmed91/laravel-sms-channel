<?php

namespace JawadAhmed\SmsChannel;

final readonly class SmsChannel
{
    public function __construct(private SmsTransport $transport) {}

    public function send(object $notifiable, object $notification): ?string
    {
        $to = $notifiable->routeNotificationFor('sms', $notification);
        if (!is_string($to) || trim($to) === '') return null;

        $message = $notification->toSms($notifiable);
        if (!$message instanceof SmsMessage) throw new \UnexpectedValueException('toSms() must return SmsMessage.');

        return $this->transport->send($to, $message);
    }
}
