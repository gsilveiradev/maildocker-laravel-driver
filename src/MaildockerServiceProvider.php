<?php

namespace Guissilveira\MailDrivers\Maildocker;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Mail\TransportManager;
use Illuminate\Support\ServiceProvider;
use Guissilveira\MailDrivers\Maildocker\Transport\MaildockerTransport;

class MaildockerServiceProvider extends ServiceProvider
{
    /**
     * After register is called on all service providers, then boot is called
     */
    public function boot()
    {
        //
    }

    /**
     * Register is called on all service providers first.
     *
     * We must register the extension before anything tries to use the mailing functionality.
     * None of the closures are executed until someone tries to send an email.
     *
     * This will register a closure which will be run when 'swift.transport' (the transport manager) is first resolved.
     * Then we extend the transport manager, by adding the Maildocker transport object as the 'maildocker' driver.
     */
    public function register()
    {
        $this->app->extend('swift.transport', function(TransportManager $manager) {
            $manager->extend('maildocker', function() {
                $config = $this->app['config']->get('services.maildocker', []);
                $client = new Client(Arr::get($config, 'guzzle', []));
                return new MaildockerTransport($client, $config['api_key'], $config['api_secret']);
            });
            return $manager;
        });
    }
}
