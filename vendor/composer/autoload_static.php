<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb6f0ef71e2e674bc430fbc45d9f4e4fc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb6f0ef71e2e674bc430fbc45d9f4e4fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb6f0ef71e2e674bc430fbc45d9f4e4fc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb6f0ef71e2e674bc430fbc45d9f4e4fc::$classMap;

        }, null, ClassLoader::class);
    }
}