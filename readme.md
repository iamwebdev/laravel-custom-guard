<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Follow steps to setup project

- Copy .env.example as .env using cmd copy .env.example .env.
- Update your composer using command composer update in cmd.
- Generate application key using php artisan key:generate.
- Setup your .env file.
- Migrate database using php artisan migrate.

## Create Admin using tinker by following steps
	
	-php artisan tinker
	-$admin = new Admin
	-$admin->name = 'Name of Admin'
	-$admin->email = 'Email of Admin'
	-$admin->password = Hash::make('Password of Admin')
	-$admin-save()

## App is ready to run
- Start laravel application using php artisan serve.

