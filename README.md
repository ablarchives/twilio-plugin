# Twilio Plugin for OctoberCMS

**Background**  
This plugin is used to add Twilio PHP library to OctoberCMS. Nothing more, nothing less.

**Features**  
- Adds the Twilio PHP library
- Adds a webhook to listen for STOP incoming SMS
- Adds a webhook to listen for incoming SMS and forward to specific number

**Functionality**
- Adds `is_unsubscribed_sms` column to `albrightlabs_client_clients` table
- Add support where needed by calling using `Twilio\Rest\Client as TwilioClient`
- Twiml app should be setup to submit SMS messages to `/twilio/sms/in` so that messages can be checked

**Usage**
- Send a message by using `AlbrightLabs\Twilio\Classes\Message` and then calling `sendTwilioSms([TO],[SMS])` statically

**Requirements**
- AlbrightLabs.Client plugin
- Twilio account
- SID and token

**Install**  
There are two options:
1. `git clone https://github.com/albrightlabs/twilio-plugin.git plugins/albrightlabs/twilio` and run `php artisan october:up`
2. `git submodule add -b master https://github.com/albrightlabs/twilio-plugin.git plugins/albrightlabs/twilio` and run `php artisan october:up`

**Contribute**  
Feel free to fork and contribute to this plugin! Please email support@albrightlabs.com with any and all questions.
