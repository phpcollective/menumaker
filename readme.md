## Laravel Menu Maker
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


Menu Maker is a nice and convenient way to manage your menu items for the Laravel framework. You can create multi level menu items for different sections of your site like Left Menu, Top Menu etc with it. It will provide the authorization of menu as well.

## Structure

Directory structure of the project are as follows:

```
config/
public/        
resources/        
src/
```


## Install

You may use Composer to install the package into your Laravel project:

``` bash
$ composer require phpcollective/menumaker
```
##### Laravel 5.5+:
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

``` php
PhpCollective\MenuMaker\MenuServiceProvider::class,
```

After installing Menu Maker, publish its assets using the `menu:install` Artisan command. It will publish all assets and configurations as well as run migrations related to menu maker.

``` bash
$ php artisan menu:install
```
Add `MenuMaker` trait in `User` model.

``` php
<?php

namespace App;

use PhpCollective\MenuMaker\MenuMaker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, MenuMaker;
    
    ...
}
```

At this point you're all good to go. See Uses for how to get started with the package.
## Usage

### Accessing Package

By default all routes are prefixed with `/menu-maker`.

* Users: `/menu-maker/users`
* Roles: `/menu-maker/roles`
* Sections: `/menu-maker/sections`
* Menus: `/menu-maker/menus`
* Permissions: `/menu-maker/permissions`

You can change this prefix by editing `path` in `config/menu.php`.

```
'path' => 'menu-maker'
```

### Middleware

Menu Maker uses `menu` for middleware. 

``` php
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('menu')->group(function () {
    // Your routes will goes here
});
```

## Credits

- [Al Amin Chayan][link-author]

## License

Laravel Menu Maker is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[ico-version]: https://img.shields.io/packagist/v/phpcollective/menumaker.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpcollective/menumaker/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpcollective/menumaker.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpcollective/menumaker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpcollective/menumaker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpcollective/menumaker
[link-travis]: https://travis-ci.org/phpcollective/menumaker
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpcollective/menumaker/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpcollective/menumaker
[link-downloads]: https://packagist.org/packages/phpcollective/menumaker
[link-author]: https://github.com/alamin-chayan