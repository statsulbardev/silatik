<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('google', function($app, $config) {
            $client = new \Google_Client();

            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            $client->refreshToken(config('filesystems.disks.google.refreshToken'));

            $service = new \Google_Service_Drive($client);

            $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, config('services.google.root_dr'));

            return new \League\Flysystem\Filesystem($adapter);
        });
    }
}
