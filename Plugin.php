<?php namespace AlbrightLabs\Twilio;

use Route;
use Backend;
use System\Classes\PluginBase;
use AlbrightLabs\Client\Models\Client;
use AlbrightLabs\Twilio\Models\Settings;

/**
 * Twilio Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Twilio',
            'description' => 'Simply adds the Twilio PHP library',
            'author'      => 'Albright Labs LLC',
            'icon'        => 'icon-phone'
        ];
    }

    /**
     * Returns required plugins.
     *
     * @return array
     */
    public $require = [
        'AlbrightLabs.Client',
    ];

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        /**
         * Include the Twilio-PHP library
         */
        require_once('assets/vendor/twilio-php/Twilio/autoload.php');

        /**
         * Adds ability for user to text STOP and for SMS to be forwarded
         */
        Route::match(array('GET', 'POST'), '/twilio/sms/in', function(){
            // check if twilio is connected
            if($sid = Settings::get('sid') && $token = Settings::get('token') && $number = Settings::get('number') && $forward = Settings::get('forward')){
                // get from number
                $from = substr($_REQUEST['From'], 2);
                // get message body
                $message = strtolower($_REQUEST['Body']);
                // request is a text message
                if(null != $from && null != $message){
                    if($client = Client::where('phone', $from)->first()){
                        if (strpos(strtolower($message), 'stop') !== false){
                            $client->is_unsubscribed = 1;
                            $client->save();
                        } else{
                            $twilio = new TwilioClient($sid, $token);
                            $twilio->messages->create(
                                '+1'.$forward,
                                array(
                                    'from' => '+1'.$number,
                                    'body' => $client->name.' '.$client->surname.' ('.$from.'): '.$message,
                                )
                            );
                        }
                    }
                    else{
                        $twilio = new TwilioClient($sid, $token);
                        $twilio->messages->create(
                            '+1'.$forward,
                            array(
                                'from' => '+1'.$number,
                                'body' => '('.$from.'): '.$message,
                            )
                        );
                    }
                }
            }
        });
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'albrightlabs.twilio.access_settings' => [
                'tab' => 'Twilio',
                'label' => 'Access Twilio settings'
            ],
        ];
    }

    /*
     * Registers any back-end settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'twilio' => [
                'label'       => 'Twilio',
                'description' => 'Connect application to Twilio account.',
                'category'    => 'Twilio',
                'icon'        => 'icon-phone',
                'class'       => 'AlbrightLabs\Twilio\Models\Settings',
                'order'       => 500,
                'keywords'    => 'twilio sms phone'
            ]
        ];
    }
}
