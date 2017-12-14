## Tao Client package

### Setup

Add the below to your .env file, these will be used to run the API and launch tao and get a outcome from it
```
TAO_API_URL="https://yourdomain/tao/"
TAO_API_USER="tao-admin"
TAO_API_PASS="tao-password"
TAO_OAUTH_KEY="oAuth-key"
TAO_OAUTH_SECRET="oAuth-secret"
```

The below will allow this package to access tao's database, this is needed for the API and other components and this package can not run without it.

```
TAODB_HOST=localhost
TAODB_DATABASE=databasname
TAODB_USERNAME=username
TAODB_PASSWORD=password
```

You will also have to modify your database.php config file and add the below under connections

```php
'connections' => [

	'taodb' => [
		'driver' => 'mysql',
		'host' => env('TAODB_HOST', '127.0.0.1'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('TAODB_DATABASE', 'forge'),
		'username' => env('TAODB_USERNAME', 'forge'),
		'password' => env('TAODB_PASSWORD', ''),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => true,
		'engine' => null,
	  ],
```

Now add the service provider in your app.php config file

```php
\EONConsulting\TaoClient\TaoClientServiceProvider::class,
```

You can now run vendor:publish to publish the config file

`php artisan vendor:publish --provider="EONConsulting\TaoClient\TaoClientServiceProvider"`

It will publish a config file in `config/tao-client.php` you can edit some default settings for tao launch in this file.

The following commands are available

```
taoclient
  taoclient:fix-iframes  Fix iframe content for tao assessments
  taoclient:remove-jobs  Clear tao results that was not completed.
  taoclient:retry-jobs   Retry jobs with no results
```

You can automate the commands by adding it to your kernal file under console

```
$schedule->command('taoclient:retry-jobs')->everyFiveMinutes();
$schedule->command('taoclient:remove-jobs')->daily();
```



### TODO

- Look into people refreshing a test without waiting for it to load, it will continue creating entries in the database until it loads.
- Look at the JS creating a iframe include to look the same as the iframe fixer command's iframes
- Ask Kenny to look at the fail and successful pages that get shown.
- Add check to launch controller, if not student then show a picture of tao, otherwise launch tao