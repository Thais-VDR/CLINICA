<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit0704f5c0a290bf547e4d85299d3f7cda
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit0704f5c0a290bf547e4d85299d3f7cda', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit0704f5c0a290bf547e4d85299d3f7cda', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit0704f5c0a290bf547e4d85299d3f7cda::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
