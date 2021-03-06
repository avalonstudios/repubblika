<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92a8167b5168b519fe5044d290d85102
{
    public static $files = array (
        'a2c48002d05f7782d8b603bd2bcb5252' => __DIR__ . '/..' . '/johnbillion/extended-cpts/extended-cpts.php',
    );

    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'ExtCPTs\\Tests\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ExtCPTs\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/johnbillion/extended-cpts/tests/phpunit',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92a8167b5168b519fe5044d290d85102::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92a8167b5168b519fe5044d290d85102::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
