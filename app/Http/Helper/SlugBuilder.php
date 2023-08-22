<?php

namespace App\Http\Helper;

use App\Models\JobPost;
use Illuminate\Support\Str;

trait SlugBUilder{

    public function slugGenerate($title){
        $slug=Str::slug($title);
        $found = JobPost::where('slug','LIKE',"%".$slug."%")->count();
        if($found){
            $slug=$slug."-".$found;
        }

        return $slug;
    }
}