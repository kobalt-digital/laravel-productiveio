<?php

namespace Kobalt\LaravelProductiveio;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;
use Kobalt\LaravelProductiveio\Commands\LaravelProductiveioCommand;

class LaravelProductiveioServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-productiveio')
            ->hasConfigFile();
    }
}
