<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit877ecf36a50915cf524712252074208c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit877ecf36a50915cf524712252074208c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit877ecf36a50915cf524712252074208c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit877ecf36a50915cf524712252074208c::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit877ecf36a50915cf524712252074208c::$classMap;

        }, null, ClassLoader::class);
    }
}
