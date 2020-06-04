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
            'description' => 'No description provided yet...',
            'author'      => 'AlbrightLabs',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AlbrightLabs\Twilio\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'albrightlabs.twilio.some_permission' => [
                'tab' => 'Twilio',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'twilio' => [
                'label'       => 'Twilio',
                'url'         => Backend::url('albrightlabs/twilio/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['albrightlabs.twilio.*'],
                'order'       => 500,
            ],
        ];
    }
}
