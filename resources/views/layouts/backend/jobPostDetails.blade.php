@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="card col-lg-12 mx-2">
            <div class="card-body">
                <h5 class="card-title">{{ $jobPost->job_title }}</h5>
                <p class="card-text">
                    {{ $jobPost->position_title }}
                    {!! $jobPost->job_description!!}
                    {{ $jobPost->job_salary_min . 'k - ' . $jobPost->job_salary_max . 'k' }} <br />
                    {{ $jobPost->job_location }}
                    {{ $jobPost->job_type }}
                </p>
            </div>
        </div>
    </div>
@endsection
