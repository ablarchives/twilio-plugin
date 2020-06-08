<?php namespace AlbrightLabs\Twilio\Classes;

use ValidationException;
use Twilio\Rest\Client as TwilioClient;
use AlbrightLabs\Twilio\Models\Settings;

/**
 * Message Class
 */
class Message
{
    /**
     * Sends an SMS
     *
     * arributes: to, sms
     *
     * usage: add use Albrightlabs\Twilio\Classes\Message, then to send message,
     * call the Message::sendTwilioSms(TO_NUMBER,MESSAGE_CONTENT).
     */
    static function sendTwilioSms($to, $sms)
    {
        if(
          $sid = Settings::get('sid') &&
          $token = Settings::get('token') &&
          $number = Settings::get('number')
        ){
            $to = str_replace('+1','',$to);
            $number = str_replace('+1','',$number);
            $twilio = new TwilioClient($sid, $token);
            $message = $twilio->messages->create(
                $to,
                [
                    'from' => $number,
                    'body' => $sms,
                ]
            );
        }
        else{
            throw new ValidationException(
              ['settings' => 'Plugin not configured to send SMS!']
            );
        }

    }
}
