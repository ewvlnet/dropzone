<?php

namespace Ewvlnet\Dropzone;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DropzoneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Loading package content.
         */
        $this->loadRoutesFrom(dropzoneBasePath('routes/web.php'));
        $this->loadViewsFrom(dropzoneBasePath('resources/views/'), 'dropzone');
        $this->loadJsonTranslationsFrom(dropzoneBasePath('resources/lang/json'));

        /**
         * Publications.
         */
        $this->publishes([dropzoneBasePath('resources/views/') => resource_path('views/vendor/dropzone')], 'dropzone-views');
        $this->publishes([dropzoneBasePath('resources/lang') => resource_path('lang/vendor/dropzone')], 'dropzone-translations');

        /**
         * Components.
         */
        $this->loadViewsFrom(dropzoneBasePath('resources/views/components'), 'dropzone-components');
        Blade::component('dropzone-components::dropzone-uploader', 'dropzone-uploader');
        Blade::component('dropzone-components::dropzone-gallery', 'dropzone-gallery');
    }

}