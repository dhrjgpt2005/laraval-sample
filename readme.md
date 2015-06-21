Laravel 4 Bootstrap .

##Requirements

	PHP >= 5.4.0
	MCrypt PHP Extension

Installation instructions for the mcrypt extension are available [here](http://php.net/manual/en/mcrypt.installation.php).

##How to install
### Step 1: Get the code
#### Option 1: Git Clone

```bash
$ git clone https://github.com/dhrjgpt2005/laraval-sample.git laravel-sample
```

#### Option 2: Download the repository

    https://github.com/dhrjgpt2005/laraval-sample/archive/master.zip

### Step 2: Use Composer to install dependencies
#### Option 1: Composer is not installed globally

```bash
$ cd laravel-sample
$ curl -s https://getcomposer.org/installer | php
$ php composer.phar install
```

#### Option 2: Composer is installed globally

```bash
$ cd laravel
$ composer install
```

### Step 3: Configure Environments

```php
$env = $app->detectEnvironment(array(

    'local' => array('your-local-machine-name'),
    'staging' => array('your-staging-machine-name'),
    'production' => array('your-production-machine-name'),
));
```

### Step 4: Configure Database

Now that you have the environment configured, you need to create a database configuration for it. Copy the file ***app/config/database.php*** in ***app/config/local*** and edit it to match your local database settings. You can remove all the parts that you have not changed as this configuration file will be loaded over the initial one.


### Step 6: Populate Database
Run these commands to create and populate Users table:

```bash
$ php artisan migrate
$ php artisan db:seed
```

### Step 7:
You can use artisan to do this

```bash
$ php artisan key:generate --env=local
```

The `--env` option allows defining which environment you would like to apply the key generation. In our case, artisan generates your key in ***app/config/local/app.php*** and leaves ***'YourSecretKey!!!'*** in ***app/config/app.php***. Now it can be generated again when you move the project to another environment.

### Step 8: Make sure app/storage is writable by your web server.

If permissions are set correctly:

```bash
$ chmod -R 775 app/storage
```

Should work, if not try

```bash
$ chmod -R 777 app/storage
```

### Step 9: Start Page (Three options for proceeding)

### User login with commenting permission
Navigate to your Laravel 4 website and login at /user/login:

    username : user
    password : user

## Create a new user
Create a new user at /user/create

### Admin login
Navigate to /admin

    username: admin
    password: admin

-----
