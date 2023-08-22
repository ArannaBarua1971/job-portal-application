<?php

namespace App\Http\Helper;

use App\Models\JobPost;
use Illuminate\Support\Str;

trait MediaStore{

    public function singleMediaStore($folderName,$file,$mode){
        $fileExt=$file->extension();
        $newFileName='cv'.uniqid().'-'.time().'.'.$fileExt;
        $file->storeAs($folderName, $newFileName, $mode);

        $fileUrl=asset('storage/cv/'.$newFileName);

        return $fileUrl;
        
    }
}