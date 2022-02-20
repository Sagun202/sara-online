<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Slider

Slider plugins is responsible to Slide.


## Following are the features

Some of specific features are listed below


- Easy to use
- Easy to Customize


## Key Components 
- Slider

## Usage
### Slider

```php

use Slider;
//return designation Collection
Slider::getSliders();


```
## Theme package has following in-built permissions
```php
        [          
           'slider_menu',
            'slider_create',
            'slider_edit',
            'slider_delete',
            'slider_view',
            'slider_update',
                            ]
```
### For Image

```php

{{ asset('storage/'.$slider->image) }}

```
