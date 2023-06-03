<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Development

The current project has package [laravel/sail](https://packagist.org/packages/laravel/sail) installed.

Steps to get a working development env:

1. Copy the **.env.example** file and change the value of the environment variables as needed

```bash
$ cp .env.example .env
```
2. Install required packages

```bash
# Using docker
$ docker run -it --rm -v $(pwd):/var/www/html -w /var/www/html/ composer install

# Or manually
$ composer install 
```

3. Install `zbar-tools` package

Since we are using Sail, and we need to customize the `Dockerfile` to install the `zbar-tools` package then we need to
run the following command:

```bash
sail artisan sail:publish
```

The above command will create a local copy of all Sail Dockerfiles under `<path_to_your_project>/docker`. The default
PHP version used by Sail is currently PHP 8.2. Open the file `<path_to_your_project>/docker/8.2/Dockerfile` and add the
package before install anything `zbar-tools`. You must end with something like the following:

```bash
RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y zbar-tools php8.2-cli php8.2-dev \ 
    ...
```

4. Build the required containers used by the app

Now that you should have a custom copy of the Dockerfile shipped with Laravel Sail is time to build the new image
containing the `zbar-tools` package. Open your `<<path_to_your_project>/docker-compose.yml` and change the image name
that gets build. 
```bash
    laravel.test:
        build:
            context: ./docker/8.2
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: sail-8.2/app-custom
        ...
```
Then run the following command:
```bash
$ ./vendor/bin/sail build --no-cache
```

5. Start up the containers

```bash
$ ./vendor/bin/sail up -d
```
> Check the [sail doc](https://laravel.com/docs/10.x/sail) for more commands to run.
> 
6. Generate the **APP_KEY** variable value

```
$ ./vendor/bin/sail artisan key:generate
```

6. Run the migrations

```
$ ./vendor/bin/sail artisan migrate
```

At this point you should be able to access the application at [http://localhost](http://localhost) 

## References
- [zbar-php](https://github.com/tarfin-labs/zbar-php)
- [How to install zbar-tools on Ubuntu](https://installati.one/install-zbar-tools-ubuntu-20-04/)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
