<?php

namespace App\Providers;

use App\Helpers\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Blade::directive("image", function (string $asset) {
            $asset = str_replace('"', "", $asset);
            $assetPath = Filesystem::join( Filesystem::root(), 'resources', 'images', $asset);
            if(!File::exists($assetPath)) { return "<-- file resources/images/$asset does not exist -->"; }
            else { return file_get_contents($assetPath); }
        });

        Blade::directive("svg", function (string $asset) {
            $asset = str_replace('"', "", $asset);
            $assetPath = Filesystem::join( Filesystem::root(), 'resources', 'svg', $asset);
            if(!File::exists($assetPath)) { return "<-- file resources/svg/$asset does not exist -->"; }
            else { return file_get_contents($assetPath); }
        });

        Blade::directive("icon", function (string $asset) {
            $asset = str_replace('"', "", $asset);
            $assetPath = Filesystem::join( Filesystem::root(), 'resources', 'svg', "icon", $asset);
            if(!File::exists($assetPath)) { return "<-- file resources/svg/icon/$asset does not exist -->"; }
            else { return file_get_contents($assetPath); }
        });

        Blade::directive("form", function (string $form) {
            $formIdentifier = str_replace('"', "", $form);
            $html = "<app-form x-data='FormController(\"{$formIdentifier}\")'>" . PHP_EOL;
            $html .= Blade::render("app.forms.{$formIdentifier}");
            $html .= "</app-form>";
            return $html;
        });

//        Blade::directive("asset", function (string $asset) {
//            $asset = str_replace('"', "", $asset);
//            $assetPath = Filesystem::join( Filesystem::root(), 'resources', 'images', $asset);
//            if(!File::exists($assetPath)) { return "<-- file resources/svg/$asset does not exist -->"; }
//            else { return file_get_contents($assetPath); }
//        });

    }
}
