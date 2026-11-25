# Laravel SMS Channel


A provider-neutral Laravel 13 notification channel with injectable transport, explicit phone routing, normalized delivery receipts, and test-friendly contracts.


Implement `SmsTransport` for Twilio, Vonage, AWS SNS, or another provider, then return an `SmsMessage` from `toSms()` on your notification. Keep provider keys in environment variables.


```bash
composer install
composer test
```

## Add this to an existing Laravel project

1. Copy `SmsChannel.php`, `SmsMessage.php`, and `SmsTransport.php` from `src/` to `app/Notifications/Channels/` and change their namespaces.
2. Create a transport class for your SMS provider that implements `SmsTransport`. Put its API key, sender, and endpoint settings in environment-backed configuration.
3. Bind `SmsTransport` to your provider implementation in a service provider.

```php
$this->app->bind(SmsTransport::class, TwilioSmsTransport::class);
```

4. Add a phone route to the notifiable model with `routeNotificationForSms()` and return a normalized international number.
5. Create a notification whose `via()` method returns `[SmsChannel::class]` and whose `toSms()` method returns an `SmsMessage`.
6. Send the notification with `$user->notify(new VerificationCodeNotification($code))` from the appropriate application service.
7. Queue provider calls, configure retries for temporary failures, and avoid retrying permanent errors such as an invalid phone number.
8. Store the provider message ID returned by `SmsChannel::send()` when delivery-status tracking is required. Verify provider webhook signatures before updating delivery state.
9. Copy `tests/SmsChannelTest.php` into your project, update its namespace and imports, and run `php artisan test` with a fake transport.
10. Test a valid route, a missing phone route, invalid message content, provider failure, and a successful delivery receipt.
