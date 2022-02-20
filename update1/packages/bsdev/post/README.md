<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Post

Post plugins is responsible to Post.


## Following are the features

Some of specific features are listed below


- Easy to use
- Easy to Customize


## Key Components 
- Type
- Category
- Post
- Comment

## Usage
### Type

```php

use Post;

//return Type Collection with Category
//Also can send limit paramert
Post::getTypes();

//return Categories object
Post::getCategoriesByType($slug);

// return Category object with posts
Post::getCategoryBySlug($slug)

// return  post object
Post::getPostBySlug($slug);

//Return post collection
Post::getPostByType($type->id)

//return Comment Collection 
Post::getCommentByPost($post->id);

//return categories collection with post 
//also can send limit
Post::getCategories($limit)


//Create Comment 
//'name'=>'required|string|max:255',
//'email'=>'required|email',
//'message'=>'required|string|max:500',
//'user_id'=>'nullable|exists:users,id'
Post::createComment($request)


//return all post with type and categories
Post::posts()



```
## Fields
```php

        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'type_id',
        'seo',
        'status',
        'position',
        'gallery',      
        'user_id',
        'likes',
        'views'

```
## Theme package has following in-built permissions
```php
        [          
            'post_menu',
            'post_create',
            'post_edit',
            'post_delete',
            'post_view',
            'post_update',
                               ]
```
### For Image

```php

{{ asset('storage/'.$post->image) }}

```

### For Gallery 

```php

@foreach($post->gallery as $gallery)

    {{ asset('storage/'.$gallery) }}

@endforeach

```



### For SEO
```php

$post->seo['meta_title']??'';
$post->seo['meta_description']??'';

```

## Create Comment
 
```php

use Post\Models\PostComment;

protected $fillable = [
        'post_id',
        'name',
        'email',
        'message',
        'user_id',
        'status'
    ];
PostComment::create($data);

```

### Increate like

```php 

use Post\Models\Post;

$post = Post::find($post->id);
$post->likes+=1;
$post->save();


```
### Increate Views

```php 

use Post\Models\Post;

$post = Post::find($post->id);
$post->views+=1;
$post->save();


```
