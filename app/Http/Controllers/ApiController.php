<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobPost;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use App\Http\Helper\SlugBUilder;
use Illuminate\Support\Facades\Auth;
use App\Http\Helper\ApiResponseBuilder;
use App\Http\Helper\MediaStore;

class ApiController extends Controller
{
    use ApiResponseBuilder,SlugBUilder,MediaStore;
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

    public function login(Request $req){
        $req->validate([
            "email"=>'required|email',
            "password"=>'required'
        ]);

        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
                $user=User::where('email',$req->email)->first();
                $userRole=User::with('roles')->where('email',$req->email)->first();
                $token=$user->createToken('token-name'.$user->name)->plainTextToken;
                $data=[
                    "user"=>$user,
                    "role"=>$userRole->roles->first()->name,
                    "user_token"=>$token
                ];
                return $this->successRsoponse("okay",200,$data);
        }else{
            return $this->failRsoponse('UN-authorized',401,[]);
        }
    }
    public function register(){
        return view('auth.register');
    }

    public function joblist(){
        $data=JobPost::where('status',1)->get();

        return $this->successRsoponse("okay",200,$data);
    }
    public function notApprovejoblist(){
        $data=JobPost::where('status',0)->get();

        return $this->successRsoponse("okay",200,$data);
    }

    public function forApprovejob(Request $req){
        $post=JobPost::where('id',$req->id)->first();
        $post->status='1';
        $post->save();

        return $this->successRsoponse("okay",200,$post);
    }

    public function jobPost(Request $request){
        $this->validation($request);


        $jobPost = new JobPost();
        $this->storeOrupdate($jobPost, $request);

        return $this->successRsoponse("okay",200,[]);
    }

    public function jobApply(Request $req){
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
        return $this->successRsoponse("applied Successfully",200,$appliedJob);
    }
}
