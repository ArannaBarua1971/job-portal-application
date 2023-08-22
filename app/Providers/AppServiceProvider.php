<?php

namespace App\Providers;

use App\Models\JobPost;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $bakendPage = ['daseboard','addPost','allJobPost','approvePost','jonPostDetails','allUser','jobPostDetails','likedPost','appliedJob','allApplyForJob','allEmploye','otherInfo','userDetails'];

        foreach ($bakendPage as $path) {
            view()->composer('layouts/backend/' . $path, function ($view) {
                $notApproveJobPost = JobPost::where('status', 0)->count();
                return $view->with('notApproveJobPost', $notApproveJobPost);
            });
        }
    }
}
