<?php

namespace App\Http\Controllers\frontend;

use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\MediaStore;
use App\Models\AppliedJob;
use App\Models\JobForUser;
use Exception;

class FrontendController extends Controller
{
    use MediaStore;
    //homepage
    public function homepage()
    {

        try {

            $allPost = JobPost::with(['jobForUser' => function ($q) {
                $q->where('user_id', auth()->user()->id);
            }])->where('status', 1)->simplePaginate(7);
            return view('layouts.frontend.Homepage', compact('allPost'));
        } catch (Exception) {
            $allPost = JobPost::where('status', 1)->simplePaginate(7);
            return view('layouts.frontend.Homepage', compact('allPost'));
        }
    }

    // job like
    public function jobLike($id)
    {
        $jobPost = new JobForUser();
        $jobPost->user_id = auth()->user()->id;
        $jobPost->job_post_id = $id;
        $jobPost->job_like = true;
        $jobPost->save();
        return back();
    }
    public function disLike($id)
    {
        $jobPost = JobForUser::where('id', $id)->delete();
        return back();
    }

    public function applyForJob($slug)
    {
        $findJob = JobPost::where('slug', $slug)->first();
        $applied=AppliedJob::where(['job_post_id'=>$findJob->id,'user_id'=>auth()->user()->id])->count();
        return view('layouts.frontend.ApplyForJob', compact('findJob','applied'));
    }

    public function applied(Request $req)
    {
        $req->validate([
            "name" => 'required',
            "email" => 'required|email',
            "phone_number" => 'required|max:11',
            "cv" => 'required|mimes:jpeg,pdf,png'
        ]);

        $appliedJob = new AppliedJob();
        $appliedJob->name = $req->name;
        $appliedJob->user_id = auth()->user()->id;
        $appliedJob->job_post_id=$req->job_post_id;
        $appliedJob->email = $req->email;
        $appliedJob->phone_number = $req->phone_number;
        $appliedJob->cv = $this->singleMediaStore('cv',$req->cv,'public');
        if (isset($req->Current_working)) {
            $appliedJob->Current_working = $req->Current_working;
        }
        $appliedJob->save();
        return back();
    }

    public function joblist(){
        $allPost = JobPost::where('status', 1)->simplePaginate(7);
        return view('layouts.frontend.JobList', compact('allPost'));
    }
}
