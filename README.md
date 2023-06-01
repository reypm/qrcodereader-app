<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Development

The current project has package [laravel/sail](https://packagist.org/packages/laravel/sail) installed.

Steps to get a working development env:

1. Copy the **.env.example** file and change the value of the environment variables needed
```
$ cp .env.example .env
```
2. Install required packager
```
# Using docker
$ docker run -it --rm -v $(pwd):/var/www/html -w /var/www/html/ composer install

# Or manually
$ composer install 
```
3. Build the required containers used by the app
```
$ ./vendor/bin/sail build
```
3. Start up the containers
```
$ ./vendor/bin/sail up -d
```
4. Check the [sail doc](https://laravel.com/docs/10.x/sail) for more commands to run.


5. Generate the **APP_KEY** variable value
```
$ ./vendor/bin/sail artisan key:generate
```
6. Run the migrations
```
$ ./vendor/bin/sail artisan migrate
```



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
