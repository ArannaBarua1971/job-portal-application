<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
     
    public function jobForUser(){
        return $this->hasMany(JobForUser::class);
    }
    public function appliedUser(){
        return $this->hasMany(AppliedJob::class);
    }
}
