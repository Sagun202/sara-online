<?php

namespace Bsdev\Post\Facades;

use Bsdev\Post\Models\Category;
use Bsdev\Post\Models\Post as Po;
use Bsdev\Post\Models\PostComment;
use Bsdev\Post\Models\Type;
use Bsdev\Post\Requests\StorePostCommentRequest;
use Bsdev\Post\Traits\Component;
use Theme;

class Post
{
    use Component;

    public function getTypes($limit = 0)
    {
        if (!Theme::checkModuleStatus('Post')) {
            return [];
        }
        if ($limit > 0) {
            return Type::where('status', 1)->with('categories')->limit($limit)->get();
        } else {

            return Type::with('categories')->get();
        }
    }
    public function getCategoriesByType($type)
    {
        if (!Theme::checkModuleStatus('Post')) {
            return [];
        }
        $type = Type::where('slug', $type)->first();

        return $type->categories()->where('status', 1)->get();

    }
    public function getCategoryBySlug($slug)
    {

        if (!Theme::checkModuleStatus('Post')) {
            return null;
        }

        return Category::where('slug', $slug)->where('status', 1)->with(['posts' => function ($query) {
            $query->where('status', 1)->orderBy('created_at', 'DESC');
        }])->first();

    }

    public function getPostBySlug($slug)
    {
        if (!Theme::checkModuleStatus('Post')) {
            return null;

        }
        return Po::where('slug', $slug)->where('status', 1)->with('posts')->first();
    }

    public function getPostByType($type, $limit = 0)
    {
        if (!Theme::checkModuleStatus('Post')) {

            return [];

        }

        $type = Type::where('slug', $type)->where('status', 1)->first();
        if (!$type) {
            return [];
        }
        if ($limit > 0) {

            return $type->posts()->with(['type', 'categories', 'user','posts'])->where('status', 1)->where('post_id',NULL)->orderBy('position', 'ASC')->paginate($limit);

        } else {

            return $type->posts()->with(['type', 'categories', 'user','posts'])->where('status', 1)->where('post_id',NULL)->orderBy('position', 'ASC')->get();
        }

    }

    public function getCommentByPost($post)
    {
        if (!Theme::checkModuleStatus('Post')) {
            return [];

        }

        $post = Po::where('id', $post)->where('status', 1)->first();

        return $post->comments()->where('status', 1)->get();

    }

    public function getCategories($limit = 0)
    {
        if (!Theme::checkModuleStatus('Post')) {

            return [];

        }

        if ($limit > 0) {

            return Category::where('status', 1)->with(['posts' => function ($query) {
                $query->orderBy('created_at', 'DESC')->where('status', 1);
            }])->limit($limit)->get();

        } else {

            return Category::where('status', 1)->with(['posts' => function ($query) {
                $query->orderBy('created_at', 'DESC')->where('status', 1);
            }])->get();
        }
    }
    public function createComment(StorePostCommentRequest $request)
    {
        if (!Theme::checkModuleStatus('Post')) {
            return response()->json(['error' => 'Something went wrong']);

        }
        try {

            $data = $request->validated();

            $comment = PostComment::create($data);

            return response()->json(['data' => $comment]);

        } catch (\Exception $ex) {

            return response()->json(['error' => 'Something went wrong']);

        }
    }
    public function posts()
    {
        return Po::with(['type', 'categories', 'user'])->get();
    }

    public function getMenu()
    {
        if (!auth()->user()->can('post_view')) {
            return '';
        }
        if (!Theme::checkModuleStatus('Post')) {
            return '';
        }
        $view = view('post::menu')->render();
        return $view;
    }

    public function getPermissions()
    {
        if (!Theme::checkModuleStatus('Post')) {
            return false;
        }

        return [

            'post_menu',
            'post_create',
            'post_edit',
            'post_delete',
            'post_view',
            'post_update',
        ];
    }

    public function getComponent()
    {
        if (!Theme::checkModuleStatus('Post')) {
            return '';
        }
        if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')){

            return view('post::component');
        }

    }

    public function getParentPost(){
        return Po::where('post_id',NULL)->get();
    }

}
