<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0fab9d71622b75ad3b4f27d4cca916af
{
    public static $files = array (
        'ebce84dc47eb1d680f29b00d0efa287f' => __DIR__ . '/../..' . '/src/Http/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'EONConsulting\\CKEditorPluginV2\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'EONConsulting\\CKEditorPluginV2\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'EONConsulting\\CKEditorPluginV2\\CKEditorPluginV2' => __DIR__ . '/../..' . '/src/CKEditorPluginV2.php',
        'EONConsulting\\CKEditorPluginV2\\CKEditorPluginV2ServiceProvider' => __DIR__ . '/../..' . '/src/CKEditorPluginV2ServiceProvider.php',
        'EONConsulting\\CKEditorPluginV2\\Facades\\CKEditorPluginV2' => __DIR__ . '/../..' . '/src/Facades/CKEditorPluginV2.php',
        'EONConsulting\\CKEditorPluginV2\\Http\\Controllers\\CKDomainsController' => __DIR__ . '/../..' . '/src/Http/Controllers/CKDomainsController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0fab9d71622b75ad3b4f27d4cca916af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0fab9d71622b75ad3b4f27d4cca916af::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0fab9d71622b75ad3b4f27d4cca916af::$classMap;

        }, null, ClassLoader::class);
    }
}
