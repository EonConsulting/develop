<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => env('APP_NAME', 'UNISA'),

    /*
     |--------------------------------------------------------------------------
     | Application Logo Config :: Peace Ngara
     |--------------------------------------------------------------------------
     */
    'logo' => env('SITE_LOGO', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJAAAAAgCAIAAABy7maaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAADyVJREFUeNrsWglUFFcWrareoGmgWZtFZFExRhQxRAEViAsIEZeJYIhLFI1xJmdmjhujJDpRNIlGQ9yymahhVBAXYkQBMYCsgiwiApF9V6FZmu6G3qpqXnUTRJam2+ic8RwefTi/qv7/9evdt9z3q1CSJJFReXUEG1XB8wmJkEpbp8ydJAllg+y9ghBkb6Pv9AvzCvqo6tXIhejoFe++O+QlXC4iWioIQRPeUYWIniDSDhRXIBiKMPQQHROUY4JxeDQOj6DrkmwzhoElhjFGAXvpIujsHOhYJIGLnsjLruEPLjBkQhRFaCRGIjhoEqX+o1JUt0tKmlpakgwGjtIQgsBJQkqgmL4tzWQcw3wcwTKjGdtgdD1qOlT5NwrYS4qCEOkUdemKtC+w7g46hEEUgiIqw1lZT+glHZyGbsOSDnpDF6KQsxwdxwYHuC/3cddhMihMUIiSBCIVKYQtZFeTtLUMM7FFWPp4j4hpaEPXMwHoQIYPv2AoMA0JfUYB00Lkdel4UhiGKyjVolj7E6zynqz0CdmgoLdg+GOMaKcxpDSmHEOLKx8VR1z5/kL6+qVuq/8yj07DMBRDdLhMHS5i5qicjMAJhMmVyyUCuUyAkgyMzsRojKFhI4muJ48ZLLaeEXcUME2FIBSKtAM0HAdDF3YiJRkSfgOBkpgpIjRFulAEAmMTjqFClNVK022js2po+vV13XtOtET+mrMx0Gu5vwfAhjwFBKNRhI/JYpsP79LglWRHbc3vp84ZT582aWnAaEjUPBySkt9/pXXzEQKpKCQrc2QkQaOCVG8GQkm4gKA0guAiEi4uc5SR7mQLiSIKDBEKmGWlGTtOmK37aKWJjSXH2lLf1ATBMOWoXvxI5QGpmgnH2yprZK38ppzsxzduISjh/O8wm9lzVH0pwMrKyvitrdDQZbNdXV1HXHxGRgZBEJ6engPO19bW1tfXOzg4jBkzRs3w5ubmqspKVdvN3Z3B6KVPAoGgqKhI1XZ2djY0NBxKb8j9+/fy8wtkcjkc0Gg0a2trb29vNps9kn8QmZmZBgYGMPPzkXik5jaBo8VpeGOpXMkWKIrRrwva7z/Rq3oEYeCIMSExQnrI5se/f7wTQ6lMROpz9K0s2JYWdK6BDodDZzApYiIWSTsFokePpFUNcmk3k0ARY2ObZUteX79GR9/gGdLR2toaHx+fkpxsa2t7ISZmxNWHhYXJpdLsnJwB5xMTEk6fPm1tZXU+OprFYg03XCQS5RcWRkdFgcbjExKMjIxU5yUSSWlp6aWLF0Vi0fff/zBYs+3t7V8dOvRbcvLTYh+ldBnx1Vfh+/a5ubmpWfOtpKR/795tYmIadSFaX19fe8AQVNRSnqdoLO3DiQIE3IRA0b6qS+UxdIJaH4GqVqccC+dJAIuAP8ALEQo7y0XChxWUV1FuSmKQplBwUGoUwTW08/HXc3IeH+DHYHMGJDUKMPAVYyPjVFCEpuFh2I6wguam5oMHDuzavXu4Po5KuXzpokJGeUnfeR6Pt2nTpuKiovyCAgWkimels7Pz/dWr+a18G9uxISHrzc3NQAkyqTQrM+vqr1dbW1rULhi5dPESKKatrS0uLi44OFhbwFBS3lHdXp1P9B6amRg5TzV2sNfh8XSMuBCZgDIo74TLpbLubpG8W4T0yBU9UplYJBeJcKEYF/cUFz4QS2Q0BCoBgop8GCYHKOmsabOmW4wfq2dtpQfFAFuPN2kiJDhgoCiG9TeYZ2g9ZMAXuEN14/qNGTNm+C5cqE4FKDb0BoDSoshBgO3bG87n8z29vL44eKA/lYKg+s8tm0VCoZp7FeTnFRffn+Yy7d69e9euXXs3OBjV8onkPcKqrC76GGvHDzeO85mPsVgYhmnro7NJslMgjk8vSEgvyims6FaoXBBFCsVWTY3eb3Lm6FtMsTKG9IYps6PSMdDWtvay8jqesYGjoz1cecGkAxw8ZP3606dOHT50aOJrr9nZ2Q0LmNLwkaGcdfC5rq6u3NwcsLi9+8IHE1/gzEMmvKexOvEmuEbIhg0QhyGTJcbHL/Tz0+65cNJ87ebZfwkENo8+l2aUlQBqxOW8F+AJPzjq6BRlFpTdfVBRXs+XKsicwuprKffFEglKEGxdloWZkZmRoZmhbsBb0709prKYdNUcL54lQu5Zu27dmdOnP/ts/5EjR3V1ddU8xJDRlULkWVQePnwol8stLC3VpEY1HOd6XJydna2LiwvcLiszM+nmTW0BY+qbjl8WpKa2fQ4B8BbNfXPRXNf+1XFf+IOkp0yCaP94+LI2f9esWfOGq2tx0X1wteFDIoqqTYfP6ItJZQhBl+A5FpOYmEgQOKQ9Op3u4jLdYdy4rKys8vJy7fwDGAGGIi9F0F6AKOelfjTlf5SCpj/zfJmAgVdt27oNyNi5s2dLS0rUcAENZeLEiRD0esTdSYk3ta2fzp87B+tRcUgGg+6zYAE0biYkvqIF4ct6vWJnb7czLAwau3ft6hQIhvYwVFMP09HReeed5dD4dM+nkZGRYrFYw2Vcv35dLBLB2L4k987yQAMDw+joKKlUOgrYM/LW3Ln+b7/d1NR07OjRIXBB1VUIg6PPho0b/fz9CZz45viJVStXXr8W19PTM+IaYmNjgVnN91nQd4ajzwlYshjHcaCLo4ANlG3bt1uNsYacH3ft10GQoFoVEuCOUNvtDd8Lvvvo0aPw8PCgwMCoqKhucfdwQwoLCkpKSpynTYOI2v+8v78/jUb75ZfY/9Gu1isEGJC6PXv20jDakaNHq6urB1JBcviQiA6d+Rf4+Jw6c2bf/v3A+vitrUe+/nr1qlUlQ6VJmPc/Z8+SBBkUFDTgkoODA1DZyspKYB9/8gHTbt8esU96WppqO+kVAAzEycnpgw83QmH78c6wQfpXk8OGpWRsXd358+dHx8QcjogwMTFpbm76YP2Gurq6Ad0a6+vvZGXr6rE9vb0HTxK8ciVAGnX+vOYP0tLS0tbWBnpvqG8ouncvKuo8n99mzuNBnSCRSGABcOnq1atQgbS2tBYWFhYXF0MGzc7ONjMzKysrO3jwYN7dPEicNTU1LWr3ZdQLvT/JJhQKjXycILS6x/tr1wJXBEP7/rvvPty0SRNUNBEPD49Lly9/EhYGjrJnz6enTp3uf/VKbCxJEhbm5l8eODCcReTn54Pfg8Npcrv6+nqWjo5cJuPz+Wm3U/eG7w8N3T558mR7B3uYB+p6XV22ra3tkSNfb9jwQVlZ6RtvuEK97+XlHRNzISQkBHpCML906VKPRLJixYo/CxgXSBSJtLe1Ue9Q1ZaHYEcKhYKlLIw0LzRCQ0MrysvP/ufs1KlT3T08+rbA/+Q3W8DX94SHr3rvvdKS0oaGBhsbG9V50CnFKUiktqYWfmq28MEnNm/erMm9GAyGsKuL4pYkaWlhiWGoTC4DSwdIvo6I4HA4BEHyzM13/GsHv61t8mSnCRMmQOUXEXHY2nqM6l4QD+rqank8C30O588CxrO0NDDiCjo7q6uqxo0fr2ZAUeE9YAvj1fYZLKZmZttCQ7dt2QKR4ceffoKlK336BZSioCkrK+vHLS0VFRV9gOVk34EgHLAkYMWKd4cbCClw89YtifHx69au5f7xxkCNvP7668A5oTF9+nQulwuNhb4LLS0tUeWlGTNmdHd35+bm1tTWubu7A5xgNBAnPTxmqV5HmJuZgUnZ2do93/udgYBBaT1v3rzYy5cLCgvVA5ZfkA96nr9ggbZ3mjVrVmBQUExMzKEvv/z8iy9UaL2QryJV28Vgzn104+TJk9AIDAxSY1hwydfHFwDLvnPHT4OdKvCwp/xFOS2wTdWRr68vtdVkZLRs2bL+Q3g8Xl97UUBAamoqlKSTnZyGpEgaGu9T0rF06VIoWY4fP9Y56FOhp+5VVPRL7C8QymfPmfMcmv3bRx9NmTIlJTnl8uXLKryG2+3QfNdOJBLVVNewmCyYWXWmID/vyZPHXl5eExwd1Y9V5ZIffzyp7YMkJCR8/vlnIxqbigqd/OEH1aG3t/df//q3vqt37tyJiIhQmWxqSqqGpvsUMEdHx4X+/lKJ9B9//3trK3/I24ft2AlaXr16dV/w0Up0dHQ+2bWLY6gfcfiwQi7XqkbJy8uTK4cMSEInjp9o7+yYOdOt90UoiXxz7ARVtr/11oiYT5o0aepU5+bGpvKHDzVZQ05ubmZmJlAJMLiVK1eBUUE7OysbYh0QyPT0dMiYYrFY0NUlFApra2v37dunYo8ZGZlNzc2qYACN27dvd3R0JCUlBa1YUV5Rcffu3QmOExQKOVBKKFFgNugAtebItH7r1q1gp+Xl5WvfXxN55ufKigocx0FNBfn5oJeQkHVt7W1+/v5r16177vAFPGr71u0KHJf0SLQKieF7974XHHzu3LmmxkYVVLk5Of8KDY2NvWJoaLhl65Zeq6qvKy0rtRk71kcZpkYUP38/WMHRI0dGXAc4BJAy4OiAFiROVbhLTU2prasFWwHeAcnpQnQ0pLHfy8ogod7NzdXT07OwsBAIBE5Oky/+8SqfyWCgKAZkx9TU1MzE5LtvvrW0sIi/cSMtLQ0Yjb29PUl9+4hDSaAuh/WWOGz2sePHIyMjz5w69e2338APgiSp1A715pvJ3LFz5+LFi7V9dzdAfBf6Ai1OTk7WagPYxcUlMSHh2NGj8NNhsXCCkMvkKBUYJoTv3w96UXWjsheKLvTz03CR0PPnM2eAl0f+/POiRYuADQ3XExiZtZWVgYEBWDCNRlO96FkUsBhqstgrV2A9+nDN0EC1RQmaxGiwBIzJZJqbmwNJYbJ6eTXgPWf2nMqqSkCOyWI5T3MeowxXPT09UGAA7z1+7NjywMBhE/ZgG4cTjQ31d/PywP2bmhrpdAZM5DnHE6YG+1Lz8FAeglPOdHODJY6YeJJ/+w0S1dx588AM+1+CogqqUzcPj4H3IpGq6qoHDx5AoQolEahs4muveXl6ub7p2v8LnNupqV0CwbwFC0b8LKdPIBB1tLejGAbRZcDnQ7eSkvrolVyuiIu7RqNhbm7u2dlZS5YshZM11dWlpaV29vbwLFC3GHK5wK2AWEGZBFmD396ux2YDe4T4nJGRMXv2bBiSkpJC4c1kQQKHSA4F3MyZM+GpnaZM+e3WLXBcYZeQRqcB+sA8NQJsVP6fZRSwV0z+K8AAQ1wGhobij4oAAAAASUVORK5CYII='),
    'logosm' => env('SITE_LOGO_SM', 'data:image/png;base64,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'),


    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', "http://localhost:8000"),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Laravel\Passport\PassportServiceProvider::class,
        Spatie\Fractal\FractalServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
        Creativeorange\Gravatar\GravatarServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,

        \EONConsulting\LaravelLTI\LaravelLTIServiceProvider::class,
        \EONConsulting\RolesPermissions\RolesPermissionsServiceProvider::class,
        \EONConsulting\AppStore\AppStoreServiceProvider::class,
        \EONConsulting\FileManager\FileManagerServiceProvider::class,
        \EONConsulting\Storyline\Core\StorylineCoreServiceProvider::class,
        \EONConsulting\Storyline\Nav\StorylineNavServiceProvider::class,
        \EONConsulting\Storyline\Menu\StorylineMenuServiceProvider::class,
        \EONConsulting\Storyline\Breadcrumbs\StorylineBreadcrumbServiceProvider::class,
        \EONConsulting\Storyline\MindMap\StorylineMindMapServiceProvider::class,
        \EONConsulting\CKEditorPluginV2\CKEditorPluginV2ServiceProvider::class,
        \EONConsulting\ImgProcessor\ImgProcessorServiceProvider::class,
        \EONConsulting\CKEditorPlugin\CKEditorPluginServiceProvider::class,
        \EONConsulting\Graphs\GraphsServiceProvider::class,
//        \EONConsulting\PHPSaasWrapper\src\PHPSaasWrapperServiceProvider::class,
        //\EONConsulting\Storyline\Breadcrumbs\StorylineBreadcrumbServiceProvider::class,
        \EONConsulting\MindMap\MindMapServiceProvider::class,
       // \EONConsulting\StoryCore\StoryCoreServiceProvider::class,
        //\EONConsulting\StoryCore\StoryCoreServiceProvider::class,
        //\EONConsulting\PHPStencil\PHPStencilServiceProvider::class,
        Baum\Providers\BaumServiceProvider::class,
        \EONConsulting\Storyline\TagCloud\StorylineTagCloudServiceProvider::class,
        \EONConsulting\Storyline\Table\StorylineTableServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        \App\Providers\ViewComposerServiceProvider::class,


    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they dont hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,

        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        'Fractal' => Spatie\Fractal\FractalFacade::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Gravatar' => Creativeorange\Gravatar\Facades\Gravatar::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'LaravelLTI' => \EONConsulting\LaravelLTI\Facades\LaravelLTI::class,
        'RolePermission' => \EONConsulting\RolesPermissions\Facades\RolesPermissions::class,
        'AppStore' => \EONConsulting\AppStore\Facades\AppStore::class,
        'StoryCore' => \EONConsulting\StoryCore\Facades\StoryCore::class,
        'FileManager' => \EONConsulting\FileManager\Facades\FileManager::class,
        'StorylineCore' => \EONConsulting\Storyline\Core\Facades\StorylineCore::class,
        'StorylineNav' => \EONConsulting\Storyline\Nav\Facades\StorylineNav::class,
        'StorylineMenu' => \EONConsulting\Storyline\Menu\Facades\StorylineMenu::class,
        'StorylineBreadcrumbs' => \EONConsulting\Storyline\Breadcrumbs\Facades\StorylineBreadcrumbs::class,
        'StorylineMindMap' => \EONConsulting\Storyline\MindMap\Facades\StorylineMindMap::class,
        'CKEditorV2' => \EONConsulting\CKEditorPluginV2\Facades\CKEditorPluginV2::class,
        'ImgProcessor' => \EONConsulting\ImgProcessor\Facades\ImgProcessor::class,
        'CKEditor' => \Packages\CKEditorPlugin\src\Facades\CKEditorPlugin::class,
        'Graphs' => \Packages\Graphs\src\Facades\Graphs::class,
//        'PHPSaasWrapper' => \EONConsulting\PHPSaasWrapper\src\Facades\PHPSaasWrapper::class,
        //'StorylineBreadcrumbs' => EONConsulting\Storyline\Breadcrumbs\StorylineBreadcrumbs::class,
        'MindMap' => \EONConsulting\MindMap\Facades\MindMap::class,
        'PHPStencil' => \EONConsulting\PHPStencil\PHPStencil::class,
    ],

];
