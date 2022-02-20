<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Team

Team plugins is responsible to manage team of any organization which has complex organizational hierarchy. This plugin need Bsdev\theme to run.

## Following are the features

Some of specific features are listed below

-   Easy to use
-   Easy to Customize
-   Team Hirearchy
-   Multiple team member in same designation

## Key Components

-   Designation
-   Team

## Usage

### Designation

```php

use Team;
//return designation Collection
Team::getParentDesignations();

//return designation Collection
Team::getChildDesignation($designation);

//return member collection
Team::getMemberByDesignation($designation);

//return team details
Team::getTeamDetail($team)

//return team collection
Team::getTeams($limit)


```

## Fields

```php

        'name',
        'email',
        'phone',
        'designation_id',
        'image',
        'introduction',
        'user_id',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'website',
        'status',
        'position'


```

## Theme package has following in-built permissions

```php
        [
           'team_menu',
            'team_create',
            'team_edit',
            'team_delete',
            'team_view',
            'team_update',
                            ]
```

### For Image

```php

{{ asset('storage/'.$team->image) }}

```
