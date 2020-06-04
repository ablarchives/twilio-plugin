<?php namespace AlbrightLabs\Twilio;

use Backend;
use System\Classes\PluginBase;

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
