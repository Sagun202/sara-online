<?php
namespace Bsdev\Seo\Facades;

class Seo
{
    public $title, $description, $keywords, $image;

    public function setSeo(...$args)
    {
        if (isset($args[0])) {

            $this->title = $args[0];
        }
        if (isset($args[1])) {

            $this->description = $args[1];
        }
        if (isset($args[2])) {

            $this->keywords = $args[2];
        }
        if (isset($args[3])) {

            $this->image = $args[3];
        }
    }

    public function getSeo()
    {
        return view('seo::template', [
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'image' => $this->image,
        ]);
    }
}
