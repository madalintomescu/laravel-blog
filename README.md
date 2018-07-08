# Laravel Blog

A basic blog system based on Laravel 5.

## Features
* Manage posts
* Featured images
* Add categories and tags
* [SummerNote](https://summernote.org/) WYSIWYG Editor
* Admin dashboard
* Manage users, roles and permissions

## Screenshots

Main page
![alt text](https://i.imgur.com/MuEz0qJ.png "Main page")

Dashboard index
![alt text](https://i.imgur.com/PvgMgjW.png "Dashboard index")

## Installation

1. Clone the repository
```
git clone https://github.com/MadalinTomescu/laravel-blog.git
```
Or use Composer
```
composer create-project madalintomescu/laravel-blog
```


2. Install the project dependencies with Composer
```
composer install
```

3. Copy `.env.example` file to `.env` file. Open it and edit it with your database details.
```
cp .env.example .env
```

4. Generate an application key
```
php artisan key:generate
```

5. Create a symbolic link from storage to public folder
```
php artisan storage:link
```

6. Install the front-end dependencies and compile them
```
npm install && npm run dev
```

7. Install sample test data
```
php artisan install:testdata
```

8. Start the server
```
php artisan serve
```

Now you can log in as admin using the following:

Email: `admin@example.com`

Password: `password`

## Dependencies

Laravel packages

* [laravel-soft-cascade](https://github.com/Askedio/laravel-soft-cascade)
* [eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable)
* [laravel-breadcrumbs](https://github.com/davejamesmiller/laravel-breadcrumbs)
* [laravel-permission](https://github.com/spatie/laravel-permission)

Front-end

* [coreui](https://github.com/coreui/coreui)
* [alertifyjs](https://github.com/MohammadYounes/AlertifyJS)
* [perfect-scrollbar](https://github.com/utatti/perfect-scrollbar)
* [select2](https://github.com/select2/select2)

## Changelog
0.1.0 - 2018-07-08
* Initial release

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
