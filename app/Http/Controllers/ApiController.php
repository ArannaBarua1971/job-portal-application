<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobPost;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use App\Http\Helper\MediaStore;
use App\Http\Helper\SlugBUilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Helper\ApiResponseBuilder;

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
            if(auth()->user()->status==0) return $this->failRsoponse('user is banned ',403,[]);
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
    public function register(Request $req){

        $searchDup=User::where('email',$req->email)->count();
        if($searchDup) return $this->failRsoponse('this email you can not used',400,[]);
        $req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            'logInWith'=>'required'
        ]);

        $user = User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
        ]);

        $user->assignRole($req['logInWith']);

        return $this->successRsoponse("you are now registered as a $req->logInWith",200,$user);
    }

    public function joblist(){
        if(auth()->user()->roles->first()->name=='admin'){
            $data=JobPost::where('status',1)->get();
            
            return $this->successRsoponse("all approved job list",200,$data);
        }
        else{
            $data=JobPost::where(['status'=>1,'user_id'=>auth()->user()->id])->get();
            return $this->successRsoponse("all approved job list",200,$data);
        }
    }
    public function pendingJoblist(){
        if(auth()->user()->roles->first()->name=='admin'){
            
            $data=JobPost::where('status',0)->get();
            $count=$data->count();
            if($count){

                return $this->successRsoponse("total pending job post",200,$data);
            }
            return $this->successRsoponse("not pending any job post",200,$data);
        }
        else{
            $data=JobPost::where(['status'=>0,'user_id'=>auth()->user()->id])->get();
            $count=$data->count();
            if($count){
    
                return $this->successRsoponse("total pending job post",200,$data);
            }
            return $this->successRsoponse("not pending any job post",200,$data);
        }
    }

    public function forApprovejob(Request $req){
        $post=JobPost::where('id',$req->id)->first();
        $post->status='1';
        $post->save();

        return $this->successRsoponse("pending job is approved now",200,$post);
    }

    public function jobPost(Request $request){
        $this->validation($request);


        $jobPost = new JobPost();
        $this->storeOrupdate($jobPost, $request);

        return $this->successRsoponse("your job is posted now it is pending",200,$jobPost);
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

    public function appliedSpecificeJob(Request $req){

        $allJopApplied = AppliedJob::whereHas('jobPost',function($q){$q->where('user_id','LIKE',auth()->user()->id);})->where('job_post_id',$req->post_id)->get();

        return $this->successRsoponse("all job applied list in this job post successfully fetched",200,$allJopApplied);

    }

    public function totalJobPost(){
        $allJobPost=JobPost::where('user_id',auth()->user()->id)->get();
        if($allJobPost){
            return $this->successRsoponse("you posted all job",200,$allJobPost);
        }
        return $this->successRsoponse("you don't  posted any job",200,$allJobPost);
    }

    // user
    public function totalUser(){
        $allUser=User::whereHas('roles',function($q){$q->where('name','user');})->where('status',1)->get();
        if($allUser){
            return $this->successRsoponse("all user info",200,$allUser);
        }
        return $this->successRsoponse("no user have",200,$allUser);
    }
    public function totalEmploye(){
        $employer=User::whereHas('roles',function($q){$q->where('name','employer');})->where('status',1)->get();
        if($employer){
            return $this->successRsoponse("all user info",200,$employer);
        }
        return $this->successRsoponse("no user have",200,$employer);
    }
    public function banUser(Request $req){
        $user=User::where(['id'=>$req->id,'status'=>1])->first();
        if($user){
            $user->status='0';
            $user->save();
            return $this->successRsoponse("the user is now ban",200,$user);
        }
        return $this->successRsoponse("The user already banned",200,$user);
    }
    public function activeUser(Request $req){
        $user=User::where(['id'=>$req->id,'status'=>0])->first();
        if($user){
            $user->status='1';
            $user->save();
            return $this->successRsoponse("the user is now active",200,$user);
        }
        return $this->successRsoponse("The user already actived",200,$user);
    }
}
