<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cloudinary\Cloudinary;

class CloudinaryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        // Debugging: check if values are null
        if (!$cloudName || !$apiKey || !$apiSecret) {
            throw new \Exception('Cloudinary environment variables are not set correctly.');
        }

        $this->app->singleton(Cloudinary::class, function ($app) use ($cloudName, $apiKey, $apiSecret) {
            return new Cloudinary([
                'cloud' => [
                    'cloud_name' => $cloudName,
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret,
                ],
                'url' => [
                    'secure' => true,
                ]
            ]);
        });
    }

    public function boot()
    {
        //
    }
}
