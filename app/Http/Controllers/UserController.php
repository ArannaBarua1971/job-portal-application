<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use App\Models\JobForUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //get all user
    public function allUser() {
        
        $allUser=User::whereHas('roles',function($q){$q->where('name','user');})->simplePaginate(12);
        return view('layouts.backend.allUser',compact('allUser'));
    }
    public function banUser($id) {
        $banUser=User::where('id',$id)->first();
        $banUser->status=0;
        $banUser->save();
        return back();
    }
    public function activeUser($id) {
        $banUser=User::where('id',$id)->first();
        $banUser->status=1;
        $banUser->save();
        return back();
    }

    public function likePost(){
        $likePost = JobForUser::with('jobPost')->where('user_id',auth()->user()->id)->get();
        return view('layouts.backend.likedPost',compact('likePost'));
    }
    public function appliedPost(){
        $appliedPost = AppliedJob::with('jobPost')->where('user_id',auth()->user()->id)->get();
        return view('layouts.backend.appliedJob',compact('appliedPost'));
    }
    public function deniedPost($id){
        $applied=AppliedJob::where('id',$id)->delete();
        return back();
    }

    public function JobAppliedPost($id){
        $appliedJob=AppliedJob::where('job_post_id',$id)->simplePaginate(12);
        return view('layouts.backend.allApplyForJob',compact('appliedJob'));
    }

    public function allEmployer(){
        $allEmployer=User::whereHas('roles',function($q){$q->where('name','employer');})->simplePaginate(12);
        return view('layouts.backend.allEmploye',compact('allEmployer'));
    }

    public function infoStore(Request $req){
        // 
        $user=User::where('id',auth()->user()->id)->first();

        $user->phone=$req->phone;
        $user->company_name=$req->company_name;
        $user->facebook=$req->facebook;
        $user->twitter=$req->twitter;
        $user->linkedin=$req->linkedin;
        $user->youtube=$req->youtube;
        $user->whatsapp=$req->whatsapp;
        $user->working_exp=$req->working_exp;
        $user->skills=$req->skills;
        $user->portfolio=$req->portfolio;
        $user->certificates=$req->certificates;

        $user->save();

        return back();
    }
    public function changePersonalInfo(Request $req){
        $req->validate(['name'=>'required']);
        $user=User::where('id',auth()->user()->id)->first();

        $user->name=$req->name;

        $user->save();

        return back();
    }

    public function userDetails($id){
        $user=User::with('AppliedJobs')->where('id',$id)->first();
        return view('layouts.backend.userDetails',compact('user'));
    }
}
