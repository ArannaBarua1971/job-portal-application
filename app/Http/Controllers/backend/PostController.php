<?php

namespace App\Http\Controllers\Backend;

use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\SlugBUilder;
use Mockery\Expectation;

class PostController extends Controller
{


    use SlugBUilder;
    //postForm
    protected function validation($request)
    {
        $request->validate([
            'jobTitle' => 'required',
            'positionTitle' => 'required',
            'jobDetails' => 'required',
            'jobLocation' => 'required',
            'jobType' => 'required',
            'jobSeats' => 'required',
            'requirdSkills' => 'required',
            'workExp' => 'required',
        ]);
    }
    protected function storeOrupdate($jobPost, $request)
    {
        $jobPost->user_id = auth()->user()->id;
        $jobPost->job_title = $request->jobTitle;
        $jobPost->position_title = $request->positionTitle;
        // dd($request);
        $jobPost->slug = $this->slugGenerate($request->positionTitle);
        $jobPost->job_description = $request->jobDetails;
        if (isset($request->jobSalaryMin)) {
            $jobPost->job_salary_min = $request->jobSalaryMin;
        }
        if (isset($request->jobSalaryMax)) {
            $jobPost->job_salary_max = $request->jobSalaryMax;
        }
        if (isset($request->jobSeats)) {
            $jobPost->seats = $request->jobSeats;
        }
        if (isset($request->education)) {
            $jobPost->education = $request->education;
        }
        $jobPost->job_location = $request->jobLocation;
        $jobPost->job_type = $request->jobType;
        $jobPost->required_skills = $request->requirdSkills;
        $jobPost->work_exp = $request->workExp;

        $jobPost->save();
    }
    public function postForm()
    {
        return view('layouts.backend.addPost');
    }

    // add post
    public function addPost(Request $request)
    {
        $this->validation($request);


        $jobPost = new JobPost();
        $this->storeOrupdate($jobPost, $request);

        return back();
    }

    public function allPost()
    {
        if (auth()->user()->roles->first()->name != 'admin') {
            $allJobPost = JobPost::with('appliedUser')->where('user_id', auth()->user()->id)->get();
            return view('layouts.backend.allJobPost', compact('allJobPost'));
        } else {
            $allJobPost = JobPost::with('appliedUser')->where('status', 1)->get();
            return view('layouts.backend.allJobPost', compact('allJobPost'));
        }
    }
    public function postDetail($id)
    {
        $jobPost = JobPost::where('id', $id)->first();
        return view('layouts.backend.jobPostDetails', compact('jobPost'));
    }
    public function postEdit($id)
    {
        $editPost = JobPost::where('id', $id)->first();
        return view('layouts.backend.addPost', compact('editPost'));
    }
    public function postUpdated(Request $request, $id)
    {
        $this->validation($request);

        $jobPost = JobPost::where('id', $id)->first();
        $this->storeOrupdate($jobPost, $request);

        $allJobPost  = JobPost::where('user_id',auth()->user()->id)->get();
        return view('layouts.backend.allJobPost',compact('allJobPost'));
    }

    public function postApproval()
    {
        $allJobPost  = JobPost::where('status', 0)->get();
        return view('layouts.backend.approvePost', compact('allJobPost'));
    }
    public function postApprove($id)
    {
        $allJobPost  = JobPost::where('id', $id)->first();
        $allJobPost->status = '1';
        $allJobPost->save();
        return back();
    }
    public function postdisApprove($id)
    {
        JobPost::where('id', $id)->delete();
        return back();
    }
}
