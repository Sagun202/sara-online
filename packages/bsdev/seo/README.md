<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Seo

Seo stands for search engine optimization. In any web site seo needs to improve their visibility.

## Laravel Seo Package

This seo package helps to improve laravel web site seo

## Following are the features

Some of specific features are listed below

-   Easy to use
-   Easy to Customize
-   Dynamic argument
-   Support image

## Usage

### In Controller

```php
use Gi\Seo\Seo;

Seo::setSeo('title', 'description', 'keywords1,keyword2,keyword3', 'image-full-url');

or
//dynamic arguement
Seo::setSeo('title');


```

### In views header

```php
{{ Seo::getSeo() }}
```

You are done!!!
