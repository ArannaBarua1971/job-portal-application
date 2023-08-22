<?php

namespace App\Http\Helper;

use App\Models\JobPost;
use Illuminate\Support\Str;

trait ApiResponseBuilder{

    public function successRsoponse($msg,$statusCode=200,$data){
        return response()->json([
            "message"=>$msg,
            "status"=>'success',
            "data"=>$data
        ],$statusCode);
    }
    public function failRsoponse($msg,$statusCode=404,$data){
        return response()->json([
            "message"=>$msg,
            "status"=>'failed',
            "data"=>$data
        ],$statusCode);
    }
}