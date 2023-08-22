@extends('includes.backend.daseboardIncluder')

@section('backend_content')
    <div class="content-wrapper">
        <div class="row">
            @forelse ($allJobPost as $post)
                <div class="card col-lg-3 mx-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->job_title }}</h5>
                        <p class="card-text">
                            {{ $post->position_title }} <br>
                            
                            {{ $post->job_salary_min . 'k - ' . $post->job_salary_max . 'k' }}
                            <br />
                            {{ $post->job_location }}
                        </p>
                        <a href="{{ route('post.detail', $post->id) }}" class="btn btn-sm btn-primary">all Details</a>

                        <a href="{{ route('post.approve', $post->id) }}" class="btn btn-sm btn-success">approve</a>

                        <a href="{{ route('post.disapprove', $post->id) }}" class="btn btn-sm btn-danger">Not approve</a>
                    </div>
                </div>
            @empty
                <h2>Not any post pending yet</h2>
            @endforelse
        </div>
    </div>
@endsection
