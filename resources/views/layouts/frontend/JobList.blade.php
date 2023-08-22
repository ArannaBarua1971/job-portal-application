@extends('includes.frontend.frontendIncluder')

@section('frontend_contnet')
    <!-- Header End -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Job List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->


    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        @foreach ($allPost as $post)
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $post->position_title }}</h5>
                                            <span class="text-truncate me-3"><i
                                                    class="fa fa-map-marker-alt text-primary me-2"></i>{{ $post->job_location }}</span>
                                            <span class="text-truncate me-0"><i
                                                    class="far fa-money-bill-alt text-primary me-2"></i>{{ $post->job_salary_min }}k
                                                - {{ $post->job_salary_max }}k</span>
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            @hasrole('user')
                                                <a class="btn btn-light btn-square me-3"
                                                    href="{{ isset($post->jobForUser->first()->job_like) ? route('disLike', $post->jobForUser->first()->id) : route('jobLike', $post->id) }}">
                                                    <i
                                                        class="{{ isset($post->jobForUser->first()->id) ? 'fas fa-heart' : 'far fa-heart text-primary' }}"></i>

                                                </a>
                                            @endhasrole
                                            <a class="btn btn-primary" style="color:white" href="@auth
                                            {{ route('applyForJob', $post->slug) }}
                                            @endauth @guest
                                                {{ route('login') }}
                                            @endguest">Apply
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <a class="btn btn-primary py-3 px-5">{{ $allPost->links() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->
@endsection
