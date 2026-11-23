# Laravel SMS Channel

A provider-neutral Laravel 13 notification channel with injectable transport, explicit phone routing, normalized delivery receipts, and test-friendly contracts.

Implement `SmsTransport` for Twilio, Vonage, AWS SNS, or another provider, then return an `SmsMessage` from `toSms()` on your notification. Keep provider keys in environment variables.

```bash
composer install
composer test
```
