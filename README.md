## Tiny Twitter API

tiny Twitter api
## Installation

```
$ git clone https://github.com/mohamedgaber-intake40/tiny-twitter
```

```
$ cd tiny-twitter
```

```
$ composer install
```

```
$ cp .env.example .env
```

```
$ php artisan key:generate
```
- add database credentials in .env file
```
$ php artisan artisan:migrate
```
- to add fake data you can run 
```
$ php artisan db:seed
```

```
$ php artisan serve
```

to run test

```
$ php artisan test
```
